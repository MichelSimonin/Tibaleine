<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-COMM-01 — Le site affiche un lien vers Facebook
 * Spécification : SPEC-COMM-01 — Critère d'acceptation : AC-01
 */
final class CaseComm01Test extends TestCase
{
    public function test_CASE_COMM_01(): void
    {
        $liens = (new \App\Service\ReseauSocialService())->liensReseauxSociaux();
        $this->assertTrue(array_key_exists('facebook', $liens));
    }
}
