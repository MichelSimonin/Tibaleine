<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-13 — Catégories d'âge et interdiction des moins de quatre ans. */
final class CaseBook13Test extends TestCase
{
    public function test_CASE_BOOK_13_categories_age_et_moins_quatre_ans_refuse(): void
    {
        $service = new \App\Service\ReglesMetierSortieService();

        $this->assertSame('enfant', $service->categorieTarif(4));
        $this->assertSame('enfant', $service->categorieTarif(11));
        $this->assertSame('adulte', $service->categorieTarif(12));
        $this->expectException(\LogicException::class);
        $service->categorieTarif(3);
    }
}
