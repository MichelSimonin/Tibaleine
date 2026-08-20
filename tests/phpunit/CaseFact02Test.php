<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-FACT-02 — Remise de 15 % sur la facture hôtel
 * Spécification : SPEC-FACT-01 — Critère d'acceptation : AC-02
 */
final class CaseFact02Test extends TestCase
{
    public function test_CASE_FACT_02(): void
    {
        $hotel = new \App\Entity\Utilisateur(); $hotel->setProfil('hotel');
        $r = new \App\Entity\Reservation(); $r->setMontantTotal(360.0); $r->setEtat('payée');
        $facture = (new \App\Service\FacturationService())->facturerHotel($hotel, [$r]);
        $this->assertSame(306.0, $facture->getMontantDu());
    }
}
