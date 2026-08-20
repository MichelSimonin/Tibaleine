<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-MODIF-04 — Une suppression de participant suit le circuit du remboursement
 * Spécification : SPEC-MODIF-01 — Critère d'acceptation : AC-04
 */
final class CaseModif04Test extends TestCase
{
    public function test_CASE_MODIF_04(): void
    {
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $reservation->setNbAdultes(3);

        $remboursement = (new \App\Service\ReservationService())->supprimerParticipant($reservation, 1);

        $this->assertSame(2, $reservation->getNbAdultes());
        $this->assertNotNull($remboursement);
    }
}
