<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Sortie;
use App\Enum\EtatSortie;
use App\Repository\ReservationRepository;

final class DisponibiliteService
{
    public function __construct(private readonly ReservationRepository $reservations) {}

    public function placesRestantes(Sortie $sortie): int
    {
        if ($sortie->getEtat() === EtatSortie::ANNULEE) { return 0; }
        return max(0, $sortie->getBateau()->getCapacite() - $this->reservations->countReservedSeats($sortie));
    }

    public function estReservable(Sortie $sortie, int $places, ?\DateTimeImmutable $maintenant = null): bool
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        return $places >= 2
            && $sortie->getDepart() > $maintenant->modify('+2 hours')
            && $this->placesRestantes($sortie) >= $places;
    }
}
