<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\Reservation;

use App\Entity\Bateau;
use App\Entity\Sortie;
use App\Entity\Utilisateur;
use App\Enum\TypeSortie;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;
use App\Service\Reservation\ReservationHotelService;
use PHPUnit\Framework\TestCase;

final class ReservationHotelServiceTest extends TestCase
{
    public function test_CASE_HOTEL_02_limite_six_places(): void
    {
        $hotel = (new Utilisateur())->setRoleMetier(UserRole::HOTEL);
        $sortie = (new Sortie())->setType(TypeSortie::DAUPHIN)->setBateau(new Bateau('Test', 12));
        $service = new ReservationHotelService();
        $service->valider($hotel, $sortie, 6);
        self::assertTrue($service->estHotel($hotel));

        $this->expectException(RegleMetierException::class);
        $service->valider($hotel, $sortie, 7);
    }

    public function test_CASE_BOOK_10_hotel_ne_peut_pas_privatiser(): void
    {
        $hotel = (new Utilisateur())->setRoleMetier(UserRole::HOTEL);
        $sortie = (new Sortie())->setType(TypeSortie::PRIVATISATION)->setBateau(new Bateau('Test', 12));

        $this->expectException(RegleMetierException::class);
        (new ReservationHotelService())->valider($hotel, $sortie, 2);
    }
}
