<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-07 — Acompte de privatisation de cinquante pour cent. */
final class CasePay07Test extends TestCase
{
    public function test_CASE_PAY_07_acompte_privatisation_50_pourcent(): void
    {
        $acompte = (new \App\Service\PaiementService())->calculerAcompte(600.0, true);

        $this->assertSame(300.0, $acompte);
        $this->assertSame(300.0, 600.0 - $acompte);
    }
}
