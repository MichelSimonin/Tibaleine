<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-DISP-07 — Les places sont décomptées dès le clic sur « Réserver »
 * Spécification : SPEC-DISP-01 — Critère d'acceptation : AC-01
 */
final class CaseDisp07Test extends TestCase
{
    public function test_CASE_DISP_07(): void
    {
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(4);
        (new \App\Service\ReservationService())->bloquerPlace($sortie, 1, new \DateTimeImmutable('2026-07-11 18:00'));
        $this->assertSame(3, $sortie->getPlacesRestantes());
    }
}
