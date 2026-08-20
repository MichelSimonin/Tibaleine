<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-HOTEL-01 — Création d'un compte hôtel
 * Spécification : SPEC-HOTEL-01 — Critère d'acceptation : AC-01
 */
final class CaseHotel01Test extends TestCase
{
    public function test_CASE_HOTEL_01(): void
    {
        $compte = (new \App\Service\CompteService())->creerCompteHotel(['email' => 'hotel@email.fr']);
        $this->assertSame('hotel', $compte->getProfil());
    }
}
