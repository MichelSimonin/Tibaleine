<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-01 — Création d'un compte au moment de la réservation, avec mot de passe
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : AC-01
 */
final class CaseAuth01Test extends TestCase
{
    public function test_CASE_AUTH_01(): void
    {
        // Quand un client crée un compte avec un mot de passe valide
        $compte = (new \App\Service\CompteService())->creerCompte([
            'email' => 'jean.edouard@email.fr',
            'mot_de_passe' => 'Baleine974!',
        ]);

        // Alors le compte est créé avec le rôle « utilisateur »
        $this->assertSame('utilisateur', $compte->getRole());
    }
}
