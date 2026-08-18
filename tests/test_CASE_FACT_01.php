<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-FACT-01 — L'hôtel est facturé en fin de mois
 * Spécification : SPEC-FACT-01 — Critère d'acceptation : AC-01
 */
final class CaseFact01Test extends TestCase
{
    public function test_CASE_FACT_01(): void
    {
        $hotel = new \App\Entity\Utilisateur(); $hotel->setProfil('hotel');
        $r1 = new \App\Entity\Reservation(); $r1->setMontantTotal(260.0); $r1->setEtat('payée');
        $r2 = new \App\Entity\Reservation(); $r2->setMontantTotal(100.0); $r2->setEtat('payée');
        $facture = (new \App\Service\FacturationService())->facturerHotel($hotel, [$r1, $r2]);
        $this->assertSame(360.0, $facture->getMontant());
    }
}
