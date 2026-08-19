<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-09 — Un client ne peut pas accéder à la vue patron
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : AC-05
 */
final class CaseAuth09Test extends TestCase
{
    public function test_CASE_AUTH_09(): void
    {
        // Étant donné un client (rôle utilisateur)
        $client = new \App\Entity\Utilisateur();
        $client->setRole('utilisateur');

        // Alors il ne peut pas accéder à l'espace de gestion
        $this->assertFalse((new \App\Service\AutorisationService())->peutAccederEspaceGestion($client));
    }
}
