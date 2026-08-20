<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-12 — Minimum de deux personnes par réservation. */
final class CaseBook12Test extends TestCase
{
    public function test_CASE_BOOK_12_minimum_deux_personnes(): void
    {
        $service = new \App\Service\ReglesMetierSortieService();

        $this->assertFalse($service->nombreReservationValide(1, 'ti_kap'));
        $this->assertTrue($service->nombreReservationValide(2, 'ti_kap'));
    }
}
