<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-03 — Connexion d'un client avec email et mot de passe
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : AC-02
 */
final class CaseAuth03Test extends TestCase
{
    public function test_CASE_AUTH_03(): void
    {
        // Étant donné un compte existant
        $service = new \App\Service\CompteService();
        $service->creerCompte(['email' => 'jean.edouard@email.fr', 'mot_de_passe' => 'Baleine974!']);

        // Quand le client se connecte avec son email et son mot de passe
        $utilisateur = $service->connecter('jean.edouard@email.fr', 'Baleine974!');

        // Alors la connexion réussit et il accède à son espace « utilisateur »
        $this->assertSame('utilisateur', $utilisateur->getRole());
    }
}
