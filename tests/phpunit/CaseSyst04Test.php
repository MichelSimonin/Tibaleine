<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-SYST-04 — Confirmation financière répétée sans doublon. */
final class CaseSyst04Test extends TestCase
{
    public function test_CASE_SYST_04_confirmation_financiere_idempotente(): void
    {
        $reservationAcompte = (new \App\Entity\Reservation())->setMontantTotal(260.0);
        $paiements = new \App\Service\PaiementService();
        $a1 = $paiements->confirmerAcompte($reservationAcompte, 78.0, 'REF-001');
        $a2 = $paiements->confirmerAcompte($reservationAcompte, 78.0, 'REF-001');
        $this->assertSame($a1, $a2);
        $this->assertSame(1, $paiements->nombreOperations());

        $reservationRemboursement = (new \App\Entity\Reservation())->setMontantEncaisse(78.0);
        $remboursements = new \App\Service\AnnulationService();
        $r1 = $remboursements->confirmerRemboursement($reservationRemboursement, 78.0, 'REF-001');
        $r2 = $remboursements->confirmerRemboursement($reservationRemboursement, 78.0, 'REF-001');
        $this->assertSame($r1, $r2);
        $this->assertSame(1, $remboursements->nombreRemboursements());
    }
}
