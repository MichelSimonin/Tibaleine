<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\TypeSortie;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;

final class ReservationHotelService
{
    public function estHotel(Utilisateur $utilisateur): bool
    {
        return $utilisateur->getRoleMetier() === UserRole::HOTEL;
    }

    public function valider(Utilisateur $utilisateur, Sortie $sortie, int $places): void
    {
        if (!$this->estHotel($utilisateur)) { return; }
        if ($places > 6) { throw new RegleMetierException('Un hôtel réserve au maximum 6 places par créneau.'); }
        if ($sortie->getType() === TypeSortie::PRIVATISATION) { throw new RegleMetierException('Un hôtel ne peut pas privatiser un bateau.'); }
    }
}
