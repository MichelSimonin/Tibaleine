<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-04-A1 — Confirmation d'une tentative initiée avant expiration. */
final class CasePay04Test extends TestCase
{
    public function test_CASE_PAY_04_A1_confirmation_apres_expiration(): void
    {
        $reservation = (new \App\Entity\Reservation())->setMontantTotal(260.0);
        $service = new \App\Service\PaiementService();
        $service->commencerTentativeAcompte(
            $reservation,
            'REF-PAY-04',
            new \DateTimeImmutable('2026-08-20 17:59'),
            new \DateTimeImmutable('2026-08-20 18:00'),
        );

        $premier = $service->confirmerTentativeAcompte('REF-PAY-04', 78.0);
        $second = $service->confirmerTentativeAcompte('REF-PAY-04', 78.0);

        $this->assertSame($premier, $second);
        $this->assertCount(1, $reservation->getPaiements());
        $this->assertSame('réservée', $reservation->getEtat());
    }
}
