<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-MODIF-01 — La demande de modification s'effectue par téléphone
 * Spécification : SPEC-MODIF-01 — Critère d'acceptation : AC-01
 */
final class CaseModif01Test extends TestCase
{
    public function test_CASE_MODIF_01(): void
    {
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $canal = (new \App\Service\ReservationService())->canalDemandeModification($reservation);
        $this->assertSame('telephone', $canal);
    }
}
