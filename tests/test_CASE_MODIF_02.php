<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-MODIF-02 — Le patron modifie une réservation payée
 * Spécification : SPEC-MODIF-01 — Critère d'acceptation : AC-02
 */
final class CaseModif02Test extends TestCase
{
    public function test_CASE_MODIF_02(): void
    {
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $reservation->setNbAdultes(2);
        $reservation->setNbEnfants(0);

        (new \App\Service\ReservationService())->modifier($reservation, ['ajouter_adultes' => 1]);

        $this->assertSame(3, $reservation->getNbAdultes() + $reservation->getNbEnfants());
    }
}
