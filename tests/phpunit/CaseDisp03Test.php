<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-DISP-03 — Badge « nouvelle place disponible » après une annulation
 * Spécification : SPEC-DISP-01 — Critère d'acceptation : AC-03
 */
final class CaseDisp03Test extends TestCase
{
    public function test_CASE_DISP_03(): void
    {
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(0);
        (new \App\Service\DisponibiliteService())->libererPlace($sortie);
        $this->assertSame(1, $sortie->getPlacesRestantes());
        $this->assertTrue($sortie->badgeNouvellePlace());
    }
}
