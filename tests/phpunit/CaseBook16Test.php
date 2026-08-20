<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-16 — Maintien d'une sortie à partir de six passagers par bateau. */
final class CaseBook16Test extends TestCase
{
    public function test_CASE_BOOK_16_seuil_maintien_six_par_bateau(): void
    {
        $service = new \App\Service\ReglesMetierSortieService();

        $this->assertFalse($service->sortieMaintenue(5));
        $this->assertTrue($service->sortieMaintenue(6));
        $this->assertFalse($service->sortieMaintenue(11, 2));
        $this->assertTrue($service->sortieMaintenue(12, 2));
    }
}
