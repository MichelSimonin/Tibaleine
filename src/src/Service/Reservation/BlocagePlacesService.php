<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\BlocagePlace;
use App\Entity\Sortie;
use App\Enum\PhaseBlocage;
use App\Exception\RegleMetierException;
use App\Repository\BlocagePlaceRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;

final class BlocagePlacesService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly BlocagePlaceRepository $blocages,
        private readonly DisponibiliteService $disponibilite,
    ) {}

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
            if (!$this->disponibilite->estReservable($sortie, 2, $maintenant)) {
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
        return $this->blocages->deleteExpired($maintenant ?? new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion')));
    }
}
