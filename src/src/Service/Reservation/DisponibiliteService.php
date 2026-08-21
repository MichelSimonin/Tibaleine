<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Sortie;
use App\Enum\EtatSortie;
use App\Repository\ReservationRepository;
use App\Repository\BlocagePlaceRepository;
use App\Entity\BlocagePlace;

final class DisponibiliteService
{
    public function __construct(
        private readonly ReservationRepository $reservations,
        private readonly BlocagePlaceRepository $blocages,
    ) {}

    public function placesRestantes(Sortie $sortie, ?\DateTimeImmutable $maintenant = null, ?BlocagePlace $ignorer = null): int
    {
        if ($sortie->getEtat() === EtatSortie::ANNULEE) { return 0; }
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        return max(0, $sortie->getBateau()->getCapacite()
            - $this->reservations->countReservedSeats($sortie)
            - $this->blocages->countActiveSeats($sortie, $maintenant, $ignorer));
    }

    public function estReservable(Sortie $sortie, int $places, ?\DateTimeImmutable $maintenant = null, ?BlocagePlace $ignorer = null): bool
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        return $places >= 2
            && $sortie->getDepart() > $maintenant->modify('+2 hours')
            && $this->placesRestantes($sortie, $maintenant, $ignorer) >= $places;
    }
}
