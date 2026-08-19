<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-COMM-02 — Le site affiche un lien vers Instagram
 * Spécification : SPEC-COMM-01 — Critère d'acceptation : AC-02
 */
final class CaseComm02Test extends TestCase
{
    public function test_CASE_COMM_02(): void
    {
        $liens = (new \App\Service\ReseauSocialService())->liensReseauxSociaux();
        $this->assertContains('instagram', $liens);
    }
}
