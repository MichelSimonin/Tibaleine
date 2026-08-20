<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-PAY-05 — Le paiement échoue (carte refusée ou service indisponible)
 * Spécification : SPEC-PAY-01 — Critère d'acceptation : AC-05
 */
final class CasePay05Test extends TestCase
{
    public function test_CASE_PAY_05(): void
    {
        // Étant donné une réservation et une carte refusée
        $reservation = new \App\Entity\Reservation();
        $service = new \App\Service\PaiementService();

        // Quand le client tente de payer
        try {
            $service->payer($reservation);
            $this->fail('Une PaiementRefuseException était attendue.');
        } catch (\App\Exception\PaiementRefuseException) {
            // Alors la réservation n'est pas marquée « payée »
            $this->assertNotSame('payée', $reservation->getEtat());
        }
    }
}
