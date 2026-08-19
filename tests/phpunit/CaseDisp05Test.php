<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-DISP-05 — L'alerte météo est affichée sur le calendrier pour les créneaux concernés
 * Spécification : SPEC-DISP-01 — Critère d'acceptation : ?
 */
final class CaseDisp05Test extends TestCase
{
    public function test_CASE_DISP_05(): void
    {
        $sortie = new \App\Entity\Sortie();
        $sortie->setAvertissementEnvoye(new \DateTimeImmutable('2026-07-11 18:00'));
        $this->assertTrue($sortie->alerteMeteoVisible());
    }
}
