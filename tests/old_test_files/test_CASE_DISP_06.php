<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-DISP-06 — Un créneau à moins de 2h du départ est affiché indisponible
 * Spécification : SPEC-DISP-01 — Critère d'acceptation : ?
 */
final class CaseDisp06Test extends TestCase
{
    public function test_CASE_DISP_06(): void
    {
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(3);
        $sortie->setDate(new \DateTimeImmutable('2026-07-12 10:00'));
        $this->assertFalse((new \App\Service\DisponibiliteService())->estReservable($sortie, new \DateTimeImmutable('2026-07-12 09:00')));
    }
}
