<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-SYST-03 — Le client est informé en cas d'indisponibilité d'un service
 * Spécification : SPEC-SYST-01 — Critère d'acceptation : AC-03
 */
final class CaseSyst03Test extends TestCase
{
    public function test_CASE_SYST_03(): void
    {
        $message = (new \App\Service\DisponibiliteService())->messageIndisponibilite('paiement');
        $this->assertStringContainsString('indisponible', $message);
    }
}
