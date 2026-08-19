<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-SYST-01 — Le système détecte l'indisponibilité d'un service externe
 * Spécification : SPEC-SYST-01 — Critère d'acceptation : AC-01
 */
final class CaseSyst01Test extends TestCase
{
    public function test_CASE_SYST_01(): void
    {
        $etat = (new \App\Service\DisponibiliteService())->verifierServiceExterne('paiement');
        $this->assertSame('indisponible', $etat);
    }
}
