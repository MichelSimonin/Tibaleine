<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-FACT-03 — Les réservations annulées ne sont pas comptabilisées
 * Spécification : SPEC-FACT-01 — Critère d'acceptation : AC-03
 */
final class CaseFact03Test extends TestCase
{
    public function test_CASE_FACT_03(): void
    {
        $hotel = new \App\Entity\Utilisateur(); $hotel->setProfil('hotel');
        $active = new \App\Entity\Reservation(); $active->setMontantTotal(360.0); $active->setEtat('payée');
        $annulee = new \App\Entity\Reservation(); $annulee->setMontantTotal(130.0); $annulee->setEtat('annulée');
        $facture = (new \App\Service\FacturationService())->facturerHotel($hotel, [$active, $annulee]);
        $this->assertSame(306.0, $facture->getMontantDu());
    }
}
