<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-02-A1 — État réservé et statut acompte payé. */
final class CasePay02Test extends TestCase
{
    public function test_CASE_PAY_02_A1_etat_et_statut_separes(): void
    {
        $reservation = (new \App\Entity\Reservation())->setMontantTotal(260.0);
        (new \App\Service\PaiementService())->confirmerAcompte($reservation, 78.0, 'ACOMPTE-PAY-02');

        $this->assertSame('réservée', $reservation->getEtat());
        $this->assertSame('acompte payé', $reservation->getStatutPaiement());
        $this->assertNotSame('payée', $reservation->getEtat());
    }
}
