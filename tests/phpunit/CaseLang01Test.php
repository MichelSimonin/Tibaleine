<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-LANG-01 — L'interface est disponible en français et en anglais
 * Spécification : SPEC-LANG-01 — Critère d'acceptation : AC-01
 */
final class CaseLang01Test extends TestCase
{
    public function test_CASE_LANG_01(): void
    {
        $langue = (new \App\Service\LangueService())->langueInterface('en');
        $this->assertSame('en', $langue);
    }
}
