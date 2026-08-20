<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-02 — Création d'un compte sans mot de passe
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : AC-01
 */
final class CaseAuth02Test extends TestCase
{
    public function test_CASE_AUTH_02(): void
    {
        // Quand un client crée un compte sans mot de passe
        $compte = (new \App\Service\CompteService())->creerCompte([
            'email' => 'marie.dupont@email.fr',
            'mot_de_passe' => null,
        ]);

        // Alors le compte est créé et le mot de passe reste vide
        $this->assertSame('utilisateur', $compte->getRole());
        $this->assertNull($compte->getMotDePasse());
    }
}
