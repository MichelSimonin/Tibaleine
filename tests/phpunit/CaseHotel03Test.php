<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-HOTEL-03 — L'hôtel consulte ses réservations
 * Spécification : SPEC-HOTEL-01 — Critère d'acceptation : AC-03
 */
final class CaseHotel03Test extends TestCase
{
    public function test_CASE_HOTEL_03(): void
    {
        $hotel = new \App\Entity\Utilisateur(); $hotel->setProfil('hotel');
        $r1 = new \App\Entity\Reservation(); $r1->setUtilisateur($hotel);
        $r2 = new \App\Entity\Reservation(); $r2->setUtilisateur($hotel);
        $autre = new \App\Entity\Reservation(); $autre->setUtilisateur(new \App\Entity\Utilisateur());
        $resultat = (new \App\Service\ConsultationService())->listerReservations($hotel, [$r1, $r2, $autre]);
        $this->assertCount(2, $resultat);
    }
}
