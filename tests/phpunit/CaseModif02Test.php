<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-MODIF-02-A1 — Montants initial et courant après modification. */
final class CaseModif02Test extends TestCase
{
    public function test_CASE_MODIF_02_A1_montants_initial_courant(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('réservée')->setMontantTotal(260.0)->setMontantEncaisse(78.0);

        (new \App\Service\ReservationService())->modifier($reservation, ['montant_courant' => 325.0]);

        $this->assertSame(260.0, $reservation->getMontantInitial());
        $this->assertSame(325.0, $reservation->getMontantCourant());
        $this->assertSame(78.0, $reservation->getMontantEncaisse());
    }
}
