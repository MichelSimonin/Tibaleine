<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-06 — Acompte standard de trente pour cent. */
final class CasePay06Test extends TestCase
{
    public function test_CASE_PAY_06_acompte_standard_30_pourcent(): void
    {
        $acompte = (new \App\Service\PaiementService())->calculerAcompte(260.0);

        $this->assertSame(78.0, $acompte);
        $this->assertSame(182.0, 260.0 - $acompte);
    }
}
