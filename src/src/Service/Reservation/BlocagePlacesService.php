<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\BlocagePlace;
use App\Entity\Sortie;
use App\Enum\PhaseBlocage;
use App\Enum\EtatSortie;
use App\Enum\TypeSortie;
use App\Exception\RegleMetierException;
use App\Repository\BlocagePlaceRepository;
use App\Repository\ReservationRepository;
use App\Repository\SortieRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;

final class BlocagePlacesService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly BlocagePlaceRepository $blocages,
        private readonly DisponibiliteService $disponibilite,
        private readonly SortieRepository $sorties,
        private readonly ReservationRepository $reservations,
        private readonly DisponibiliteCreneauService $creneaux,
    ) {}

    public function demarrerPourCreneau(
        Sortie $reference,
        TypeSortie $type,
        ?int $bateauId = null,
        ?string $jetonExistant = null,
        ?\DateTimeImmutable $maintenant = null,
    ): BlocagePlace {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($jetonExistant !== null) {
            $existant = $this->blocages->findOneBy(['jeton' => $jetonExistant]);
            if ($existant !== null && !$existant->estExpire($maintenant)
                && $existant->getSortie()->getDate() == $reference->getDate()
                && $existant->getSortie()->getHeureDepart() == $reference->getHeureDepart()
                && $existant->getSortie()->getType() === $type
                && ($bateauId === null || $existant->getSortie()->getBateau()->getId() === $bateauId)) {
                return $existant;
            }
        }

        $this->em->getConnection()->beginTransaction();
        try {
            $sorties = $this->sorties->findForCreneau($reference, true);
            $this->blocages->deleteExpired($maintenant);
            $this->libererAffectationsInutilisees($sorties, $maintenant);
            // Les anciennes données pouvaient contenir un type préaffecté sans réservation.
            // On matérialise leur libération avant d'affecter le nouveau choix afin que le
            // trigger PostgreSQL d'exclusivité voie un état cohérent du créneau.
            $this->em->flush();
            if ($reference->getDepart() <= $maintenant->modify('+2 hours')) {
                throw new RegleMetierException('Ce créneau n’est plus disponible à la réservation.');
            }
            $sortie = $this->selectionnerSortie($sorties, $type, $bateauId, $maintenant);
            $sortie->setType($type);
            $blocage = (new BlocagePlace())->setSortie($sortie)->setNombrePlaces(2)->setExpireLe($maintenant->modify('+15 minutes'));
            $this->em->persist($blocage);
            $this->em->flush();
            $this->em->getConnection()->commit();
            return $blocage;
        } catch (\Throwable $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }

    public function demarrer(Sortie $sortie, ?string $jetonExistant = null, ?\DateTimeImmutable $maintenant = null): BlocagePlace
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($jetonExistant !== null) {
            $existant = $this->blocages->findOneBy(['jeton' => $jetonExistant, 'sortie' => $sortie]);
            if ($existant !== null && !$existant->estExpire($maintenant)) { return $existant; }
        }
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->lock($sortie, LockMode::PESSIMISTIC_WRITE);
            $this->blocages->deleteExpired($maintenant);
            if ($sortie->getEtat() === EtatSortie::ANNULEE || $sortie->getDepart() <= $maintenant->modify('+2 hours')) {
                throw new RegleMetierException('Ce créneau n’est plus disponible à la réservation.');
            }
            if ($this->disponibilite->placesRestantes($sortie, $maintenant) < 2) {
                throw new RegleMetierException('Ce créneau ne dispose plus de deux places pendant la saisie.');
            }
            $blocage = (new BlocagePlace())->setSortie($sortie)->setNombrePlaces(2)->setExpireLe($maintenant->modify('+15 minutes'));
            $this->em->persist($blocage);
            $this->em->flush();
            $this->em->getConnection()->commit();
            return $blocage;
        } catch (\Throwable $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }

    public function preparerPaiement(string $jeton, Sortie $sortie, int $nombrePlaces, \DateTimeImmutable $maintenant): BlocagePlace
    {
        $blocage = $this->blocages->findOneBy(['jeton' => $jeton, 'sortie' => $sortie]);
        if ($blocage === null || $blocage->estExpire($maintenant)) {
            throw new RegleMetierException('Votre blocage de places a expiré. Rechargez le formulaire.');
        }
        if (!$this->disponibilite->estReservable($sortie, $nombrePlaces, $maintenant, $blocage)) {
            throw new RegleMetierException('Le nombre de places demandé n’est plus disponible.');
        }
        $blocage->setNombrePlaces($nombrePlaces)->setPhase(PhaseBlocage::PAIEMENT)->setExpireLe($maintenant->modify('+15 minutes'));
        return $blocage;
    }

    public function consommer(BlocagePlace $blocage): void { $this->em->remove($blocage); }
    public function nettoyer(?\DateTimeImmutable $maintenant = null): int
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        $expires = $this->blocages->findExpired($maintenant);
        $sorties = [];
        foreach ($expires as $blocage) {
            $sorties[$blocage->getSortie()->getId() ?? spl_object_id($blocage->getSortie())] = $blocage->getSortie();
            $this->em->remove($blocage);
        }
        $this->em->flush();
        $this->libererAffectationsInutilisees(array_values($sorties), $maintenant);
        $this->em->flush();
        return count($expires);
    }

    /** @param list<Sortie> $sorties */
    private function selectionnerSortie(array $sorties, TypeSortie $type, ?int $bateauId, \DateTimeImmutable $maintenant): Sortie
    {
        $mobilisees = array_values(array_filter($sorties, fn (Sortie $sortie): bool => $this->creneaux->estMobilisee($sortie, $maintenant)));
        if ($type === TypeSortie::PRIVATISATION) {
            if ($mobilisees !== []) { throw new RegleMetierException('La privatisation n’est plus disponible : une sortie est déjà sélectionnée sur ce créneau.'); }
            $candidates = array_values(array_filter($sorties, static fn (Sortie $sortie): bool => $bateauId === null || $sortie->getBateau()->getId() === $bateauId));
            if ($candidates === []) { throw new RegleMetierException('Le bateau demandé n’est pas disponible pour la privatisation.'); }
            usort($candidates, static fn (Sortie $a, Sortie $b): int => $b->getBateau()->getCapacite() <=> $a->getBateau()->getCapacite());
            return $candidates[0];
        }
        if (array_filter($mobilisees, static fn (Sortie $sortie): bool => $sortie->getType() === TypeSortie::PRIVATISATION)) {
            throw new RegleMetierException('Ce créneau est réservé à une privatisation.');
        }

        $affectees = array_values(array_filter($mobilisees, static fn (Sortie $sortie): bool => $sortie->getType() === $type));
        $libres = array_values(array_filter($sorties, fn (Sortie $sortie): bool => !$this->creneaux->estMobilisee($sortie, $maintenant)));
        $candidates = $type === TypeSortie::BALEINE && $affectees !== [] ? $affectees : [...$affectees, ...$libres];
        usort($candidates, function (Sortie $a, Sortie $b) use ($maintenant): int {
            $placesA = $this->creneaux->estMobilisee($a, $maintenant) ? $this->disponibilite->placesRestantes($a, $maintenant) : $a->getBateau()->getCapacite();
            $placesB = $this->creneaux->estMobilisee($b, $maintenant) ? $this->disponibilite->placesRestantes($b, $maintenant) : $b->getBateau()->getCapacite();
            return $placesB <=> $placesA;
        });
        foreach ($candidates as $candidate) {
            $places = $this->creneaux->estMobilisee($candidate, $maintenant)
                ? $this->disponibilite->placesRestantes($candidate, $maintenant)
                : $candidate->getBateau()->getCapacite();
            if ($places >= 2) { return $candidate; }
        }
        throw new RegleMetierException('Ce type de sortie ne dispose plus de deux places sur ce créneau.');
    }

    /** @param list<Sortie> $sorties */
    private function libererAffectationsInutilisees(array $sorties, \DateTimeImmutable $maintenant): void
    {
        foreach ($sorties as $sortie) {
            if ($sortie->getType() !== null
                && $this->reservations->countReservedSeats($sortie) === 0
                && $this->blocages->countActiveSeats($sortie, $maintenant) === 0) {
                $sortie->libererType();
            }
        }
    }
}
