<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-MODIF-03-A1 — Ajout intégré au solde restant. */
final class CaseModif03Test extends TestCase
{
    public function test_CASE_MODIF_03_A1_ajout_augmente_solde(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setMontantTotal(260.0)->setMontantEncaisse(78.0)->setNbAdultes(4);

        $supplement = (new \App\Service\ReservationService())
            ->ajouterParticipant($reservation, 1, 325.0);

        $this->assertSame(260.0, $reservation->getMontantInitial());
        $this->assertSame(325.0, $reservation->getMontantCourant());
        $this->assertSame(78.0, $reservation->getMontantEncaisse());
        $this->assertSame(247.0, $reservation->getSoldeRestant());
        $this->assertFalse($supplement->getLienPaiementEnvoye());
    }
}
