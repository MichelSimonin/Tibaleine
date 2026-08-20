<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-HOTEL-03-A1 — Consultation limitée pour le rôle hotel. */
final class CaseHotel03Test extends TestCase
{
    public function test_CASE_HOTEL_03_A1_acces_limite(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $reservations = [
            (new \App\Entity\Reservation())->setUtilisateur($hotel),
            (new \App\Entity\Reservation())->setUtilisateur($hotel),
            (new \App\Entity\Reservation())->setUtilisateur(new \App\Entity\Utilisateur()),
            (new \App\Entity\Reservation())->setUtilisateur(new \App\Entity\Utilisateur()),
            (new \App\Entity\Reservation())->setUtilisateur(new \App\Entity\Utilisateur()),
        ];
        $resultat = (new \App\Service\ConsultationService())->listerReservations($hotel, $reservations);
        $autorisation = new \App\Service\AutorisationService();

        $this->assertCount(2, $resultat);
        $this->assertFalse($autorisation->peutConsulter($hotel));
        $this->assertFalse($autorisation->peutModifier($hotel));
        $this->assertFalse($autorisation->peutAnnuler($hotel));
    }
}
