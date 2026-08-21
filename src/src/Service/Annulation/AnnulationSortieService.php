<?php

declare(strict_types=1);

namespace App\Service\Annulation;

use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Enum\CanalPaiement;
use App\Enum\ChoixAnnulation;
use App\Enum\EtatReservation;
use App\Enum\EtatSortie;
use App\Enum\OrigineAnnulation;
use App\Enum\StatutOperation;
use App\Enum\StatutPaiement;
use App\Enum\TypePaiement;
use App\Exception\RegleMetierException;
use App\Repository\PaiementRepository;
use App\Service\Notification\NotificationService;
use App\Service\Paiement\Montant;
use App\Service\Reservation\DisponibiliteService;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;

final class AnnulationSortieService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly NotificationService $notifications,
        private readonly PaiementRepository $paiements,
        private readonly DisponibiliteService $disponibilite,
    ) {}

    public function annuler(Sortie $sortie, string $motif, ?\DateTimeImmutable $maintenant = null): int
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($sortie->getEtat() === EtatSortie::ANNULEE || $sortie->getDepart() < $maintenant->modify('+2 hours')) {
            throw new RegleMetierException('Cette sortie ne peut plus être annulée.');
        }
        $sortie->setEtat(EtatSortie::ANNULEE);
        $nombre = 0;
        foreach ($sortie->getReservations() as $reservation) {
            if ($reservation->getEtat() !== EtatReservation::RESERVEE) { continue; }
            $reservation->setEtat(EtatReservation::ANNULEE)->setOrigineAnnulation(OrigineAnnulation::PRESTATAIRE)
                ->setMotifAnnulation(trim($motif) ?: 'Annulation de la sortie par Ti Baleine');
            $this->notifications->tracerAnnulationSortie($sortie, $reservation, $reservation->getMotifAnnulation() ?? 'Sortie annulée', $maintenant);
            ++$nombre;
        }
        $this->em->flush();
        return $nombre;
    }

    public function rembourser(Reservation $reservation): string
    {
        if ($reservation->getOrigineAnnulation() !== OrigineAnnulation::PRESTATAIRE || $reservation->getEtat() !== EtatReservation::ANNULEE) {
            throw new RegleMetierException('Cette réservation ne relève pas d’une annulation prestataire.');
        }
        if ($reservation->getChoixAnnulation() === ChoixAnnulation::REPORT) { throw new RegleMetierException('Un report a déjà été choisi.'); }
        $reference = 'remb_prestataire_'.$reservation->getId();
        $existant = $this->paiements->findOneBy(['referenceExterne' => $reference]);
        if ($existant !== null) { return $existant->getMontant(); }
        $encaisse = 0;
        foreach ($reservation->getPaiements() as $paiement) {
            if ($paiement->getStatut() === StatutOperation::PAYE && $paiement->getType() !== TypePaiement::REMBOURSEMENT) {
                $encaisse += Montant::enCentimes($paiement->getMontant());
            }
        }
        if ($encaisse > 0) {
            $reservation->addPaiement((new Paiement())->setType(TypePaiement::REMBOURSEMENT)->setCanal(CanalPaiement::EN_LIGNE)
                ->setMontant(Montant::depuisCentimes($encaisse))->setReferenceExterne($reference)->confirmer());
            $reservation->setStatutPaiement(StatutPaiement::REMBOURSE);
        }
        $reservation->setChoixAnnulation(ChoixAnnulation::REMBOURSEMENT);
        $this->em->flush();
        return Montant::depuisCentimes($encaisse);
    }

    public function reporter(Reservation $reservation, Sortie $nouvelleSortie, ?\DateTimeImmutable $maintenant = null): void
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($reservation->getOrigineAnnulation() !== OrigineAnnulation::PRESTATAIRE || $reservation->getEtat() !== EtatReservation::ANNULEE) {
            throw new RegleMetierException('Cette réservation ne peut pas être reportée.');
        }
        if ($reservation->getChoixAnnulation() === ChoixAnnulation::REMBOURSEMENT) { throw new RegleMetierException('Un remboursement a déjà été choisi.'); }
        if ($nouvelleSortie->getType() !== $reservation->getSortie()->getType()) { throw new RegleMetierException('Le report doit conserver le même type de sortie.'); }
        $this->em->getConnection()->beginTransaction();
        try {
            $this->em->lock($nouvelleSortie, LockMode::PESSIMISTIC_WRITE);
            if (!$this->disponibilite->estReservable($nouvelleSortie, $reservation->getNombreParticipants(), $maintenant)) {
                throw new RegleMetierException('Le nouveau créneau n’a pas assez de places.');
            }
            $reservation->setChoixAnnulation(ChoixAnnulation::REPORT)->setSortie($nouvelleSortie)->setEtat(EtatReservation::RESERVEE);
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (\Throwable $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }
}
