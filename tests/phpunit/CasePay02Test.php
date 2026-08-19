<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-PAY-02 — La réservation passe à l'état « payée » après paiement
 * Spécification : SPEC-PAY-01 — Critère d'acceptation : AC-02
 */
final class CasePay02Test extends TestCase
{
    public function test_CASE_PAY_02(): void
    {
        // Étant donné une réservation
        $reservation = new \App\Entity\Reservation();

        // Quand le client paie en ligne
        (new \App\Service\PaiementService())->payer($reservation);

        // Alors la réservation passe à l'état « payée »
        $this->assertSame('payée', $reservation->getEtat());
    }
}
