<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-13 — Solde impayé et embarquement refusé. */
final class CasePay13Test extends TestCase
{
    public function test_CASE_PAY_13_solde_impaye_embarquement_refuse(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('réservée')->setStatutPaiement('acompte payé');

        $autorise = (new \App\Service\PaiementService())->verifierEmbarquement($reservation);

        $this->assertFalse($autorise);
        $this->assertSame('annulée', $reservation->getEtat());
        $this->assertNotSame('intégralement payé', $reservation->getStatutPaiement());
    }
}
