<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-SYST-05 — Confirmation invalide ou absente sans encaissement. */
final class CaseSyst05Test extends TestCase
{
    public function test_CASE_SYST_05_confirmation_invalide_absente(): void
    {
        foreach ([false, null] as $confirmation) {
            $reservation = (new \App\Entity\Reservation())->setMontantTotal(260.0);
            $service = new \App\Service\PaiementService();
            $paiement = $confirmation === null
                ? null
                : $service->confirmerAcompte($reservation, 78.0, 'REF-INVALID-' . (int) $confirmation, $confirmation);

            $this->assertNull($paiement);
            $this->assertSame(0, $service->nombreOperations());
            $this->assertCount(0, $reservation->getPaiements());
            $this->assertNotSame('acompte payé', $reservation->getStatutPaiement());
        }
    }
}
