<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-01-A1 — Enregistrement d'un acompte en ligne. */
final class CasePay01Test extends TestCase
{
    public function test_CASE_PAY_01_A1_enregistrement_acompte(): void
    {
        $reservation = (new \App\Entity\Reservation())->setMontantTotal(260.0);
        $service = new \App\Service\PaiementService();

        $paiement = $service->confirmerAcompte($reservation, 78.0, 'ACOMPTE-PAY-01');

        $this->assertSame(78.0, $paiement?->getMontant());
        $this->assertSame('acompte', $paiement?->getType());
        $this->assertSame(182.0, $reservation->getSoldeRestant());
        $this->assertCount(1, $reservation->getPaiements());
    }
}
