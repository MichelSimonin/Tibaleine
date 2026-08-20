<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-FACT-01-A1 — Émission d'une facture hôtel sans règlement. */
final class CaseFact01Test extends TestCase
{
    public function test_CASE_FACT_01_A1_emission_sans_reglement(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $r1 = (new \App\Entity\Reservation())->setUtilisateur($hotel)->setMontantTotal(260.0)->setEtat('réservée');
        $r2 = (new \App\Entity\Reservation())->setUtilisateur($hotel)->setMontantTotal(100.0)->setEtat('réservée');

        $facture = (new \App\Service\FacturationService())->facturerHotel($hotel, [$r1, $r2]);

        $this->assertSame(360.0, $facture->getMontant());
        $this->assertSame('en attente de paiement', $facture->getStatutPaiement());
        $this->assertCount(0, $facture->getPaiements());
        $this->assertSame('en attente de paiement', $r1->getStatutPaiement());
        $this->assertSame('en attente de paiement', $r2->getStatutPaiement());
    }
}
