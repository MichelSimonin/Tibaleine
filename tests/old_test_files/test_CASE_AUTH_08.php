<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-08 — L'administrateur a un accès complet
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : AC-04
 */
final class CaseAuth08Test extends TestCase
{
    public function test_CASE_AUTH_08(): void
    {
        // Étant donné l'administrateur
        $admin = new \App\Entity\Utilisateur();
        $admin->setRole('administrateur');
        $service = new \App\Service\AutorisationService();

        // Alors il a un accès complet
        $this->assertTrue($service->peutConsulter($admin));
        $this->assertTrue($service->peutModifier($admin));
        $this->assertTrue($service->peutAnnuler($admin));
    }
}
