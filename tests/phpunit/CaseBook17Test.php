<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-17 — Une baleine par créneau et départ synchronisé des deux bateaux. */
final class CaseBook17Test extends TestCase
{
    public function test_CASE_BOOK_17_unicite_baleine_et_departs_synchronises(): void
    {
        $service = new \App\Service\ReglesMetierSortieService();

        $this->assertTrue($service->peutAjouterSortieBaleine(['dauphin']));
        $this->assertFalse($service->peutAjouterSortieBaleine(['baleine']));
        $this->assertTrue($service->departsSynchronises(
            new \DateTimeImmutable('2026-08-22 10:00'),
            new \DateTimeImmutable('2026-08-22 10:00'),
        ));
        $this->assertFalse($service->departsSynchronises(
            new \DateTimeImmutable('2026-08-22 10:00'),
            new \DateTimeImmutable('2026-08-22 10:15'),
        ));
    }
}
