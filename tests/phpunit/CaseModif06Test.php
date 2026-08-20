<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-MODIF-06 — Modification refusée hors capacité ou délai. */
final class CaseModif06Test extends TestCase
{
    public function test_CASE_MODIF_06_refus_capacite_delai(): void
    {
        foreach ([[false, true], [true, false]] as [$capacite, $delai]) {
            $reservation = (new \App\Entity\Reservation())
                ->setNbAdultes(2)->setMontantTotal(260.0)->setMontantEncaisse(78.0);
            try {
                (new \App\Service\ReservationService())
                    ->modifierSousContraintes($reservation, 325.0, $capacite, $delai);
                $this->fail('La modification devait être refusée.');
            } catch (\LogicException) {
                $this->assertSame(2, $reservation->getNbAdultes());
                $this->assertSame(260.0, $reservation->getMontantCourant());
                $this->assertSame(182.0, $reservation->getSoldeRestant());
            }
        }
    }
}
