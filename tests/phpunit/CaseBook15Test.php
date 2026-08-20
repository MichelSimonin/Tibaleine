<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-15 — Horaires et durées des sorties. */
final class CaseBook15Test extends TestCase
{
    public function test_CASE_BOOK_15_horaires_durees_et_privatisation_matin(): void
    {
        $service = new \App\Service\ReglesMetierSortieService();

        $this->assertSame(['07:00', '10:00', '14:00'], $service->creneauxHabituels());
        $this->assertSame(150, $service->dureeMinutes('baleine'));
        $this->assertSame(120, $service->dureeMinutes('dauphin'));
        $this->assertTrue($service->privatisationPossibleLeMatin('10:00'));
        $this->assertFalse($service->privatisationPossibleLeMatin('14:00'));
    }
}
