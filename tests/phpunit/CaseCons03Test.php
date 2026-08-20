<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CONS-03-A1 — Le patron voit acompte, solde et mode prévu. */
final class CaseCons03Test extends TestCase
{
    public function test_CASE_CONS_03_A1_patron_voit_solde_mode(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setMontantTotal(260.0)->setMontantEncaisse(78.0)
            ->setModePaiementPrevu('sur place')->setEtat('réservée')->setStatutPaiement('acompte payé');

        $this->assertSame(78.0, $reservation->getMontantEncaisse());
        $this->assertSame(182.0, $reservation->getSoldeRestant());
        $this->assertSame('sur place', $reservation->getModePaiementPrevu());
        $this->assertSame('réservée', $reservation->getEtat());
        $this->assertSame('acompte payé', $reservation->getStatutPaiement());
    }
}
