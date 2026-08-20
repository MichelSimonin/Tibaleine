<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-DISP-02 — Un créneau complet est affiché comme indisponible
 * Spécification : SPEC-DISP-01 — Critère d'acceptation : AC-02
 */
final class CaseDisp02Test extends TestCase
{
    public function test_CASE_DISP_02(): void
    {
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(0);
        $this->assertFalse((new \App\Service\DisponibiliteService())->estDisponible($sortie));
        $reservation = (new \App\Entity\Reservation())->setSortie($sortie)->setNbAdultes(1);
        $this->assertFalse((new \App\Service\ReservationService())->reserverSiDisponible($reservation));
    }
}
