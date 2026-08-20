<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-DISP-01 — Un client voit les places restantes d'un créneau
 * Spécification : SPEC-DISP-01 — Critère d'acceptation : AC-01
 */
final class CaseDisp01Test extends TestCase
{
    public function test_CASE_DISP_01(): void
    {
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(4);
        $service = new \App\Service\DisponibiliteService();
        $this->assertTrue($service->estDisponible($sortie));
        $this->assertSame(4, $sortie->getPlacesRestantes());
    }
}
