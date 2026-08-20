<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-PAY-01 — Le client paie sa réservation en ligne
 * Spécification : SPEC-PAY-01 — Critère d'acceptation : AC-01
 */
final class CasePay01Test extends TestCase
{
    public function test_CASE_PAY_01(): void
    {
        // Étant donné une réservation d'un montant de 260 €
        $reservation = new \App\Entity\Reservation();
        $reservation->setMontantTotal(260.0);

        // Quand le client paie en ligne
        $paiement = (new \App\Service\PaiementService())->payer($reservation);

        // Alors le paiement est enregistré
        $this->assertSame(260.0, $paiement->getMontant());
    }
}
