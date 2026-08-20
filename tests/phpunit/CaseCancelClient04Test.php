<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-04 — Absence sans remboursement. */
final class CaseCancelClient04Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_04_absence_sans_remboursement(): void
    {
        $reservation = (new \App\Entity\Reservation())->setEtat('réservée')->setMontantEncaisse(78.0);
        $remboursement = (new \App\Service\AnnulationService())->enregistrerAbsence($reservation);

        $this->assertNull($remboursement);
        $this->assertSame('réalisée', $reservation->getEtat());
        $this->assertCount(0, $reservation->getRemboursements());
    }
}
