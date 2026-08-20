<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-FACT-03 — Une réservation annulée est exclue. */
final class CaseFact03Test extends TestCase
{
    public function test_CASE_FACT_03_reservation_annulee_non_comptabilisee(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $r1 = (new \App\Entity\Reservation())->setUtilisateur($hotel)->setMontantTotal(180.0)->setEtat('réservée');
        $r2 = (new \App\Entity\Reservation())->setUtilisateur($hotel)->setMontantTotal(180.0)->setEtat('réservée');
        $annulee = (new \App\Entity\Reservation())->setUtilisateur($hotel)->setMontantTotal(130.0)->setEtat('annulée');

        $facture = (new \App\Service\FacturationService())->facturerHotel($hotel, [$r1, $r2, $annulee]);

        $this->assertSame(360.0, $facture->getMontant());
        $this->assertSame(306.0, $facture->getMontantDu());
        $this->assertCount(2, $facture->getReservations());
    }
}
