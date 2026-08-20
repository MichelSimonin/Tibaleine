<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-11 — Capacités maximales des bateaux. */
final class CaseBook11Test extends TestCase
{
    public function test_CASE_BOOK_11_capacites_bateaux_12_24(): void
    {
        $service = new \App\Service\ReglesMetierSortieService();

        $this->assertSame(12, $service->capaciteBateau('ti_kap'));
        $this->assertSame(24, $service->capaciteBateau('grand_bleu'));
        $this->assertTrue($service->nombreReservationValide(12, 'ti_kap'));
        $this->assertFalse($service->nombreReservationValide(13, 'ti_kap'));
        $this->assertTrue($service->nombreReservationValide(24, 'grand_bleu'));
        $this->assertFalse($service->nombreReservationValide(25, 'grand_bleu'));
    }
}
