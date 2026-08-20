<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-14 — Tarifs des sorties et des privatisations. */
final class CaseBook14Test extends TestCase
{
    public function test_CASE_BOOK_14_tarifs_sorties_et_privatisations(): void
    {
        $service = new \App\Service\ReglesMetierSortieService();

        $this->assertSame(105.0, $service->calculerTarif('baleine', [35, 8]));
        $this->assertSame(80.0, $service->calculerTarif('dauphin', [35, 8]));
        $this->assertSame(600.0, $service->calculerTarif('privatisation', [], 'ti_kap'));
        $this->assertSame(1100.0, $service->calculerTarif('privatisation', [], 'grand_bleu'));
    }
}
