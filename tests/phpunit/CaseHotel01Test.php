<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-HOTEL-01-A1 — Hôtel représenté uniquement par un rôle utilisateur. */
final class CaseHotel01Test extends TestCase
{
    public function test_CASE_HOTEL_01_A1_role_hotel_sans_profil(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setEmail('hotel@example.test')->setRole('hotel');
        $reservation = (new \App\Entity\Reservation())->setUtilisateur($hotel);

        $this->assertTrue($reservation->estReservationHotel());
        $this->assertSame($hotel, $reservation->getUtilisateur());
        $this->assertSame('hotel', $reservation->getUtilisateur()?->getRole());
        $this->assertNull($hotel->getProfil());
        $this->assertNull($reservation->getProfil());
    }
}
