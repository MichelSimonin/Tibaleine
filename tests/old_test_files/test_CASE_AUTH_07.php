<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-07 — L'employé accède aux réservations en lecture seule
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : AC-03
 */
final class CaseAuth07Test extends TestCase
{
    public function test_CASE_AUTH_07(): void
    {
        // Étant donné un employé
        $employe = new \App\Entity\Utilisateur();
        $employe->setRole('employe');
        $service = new \App\Service\AutorisationService();

        // Alors il consulte en lecture seule, sans modifier ni annuler
        $this->assertTrue($service->peutConsulter($employe));
        $this->assertFalse($service->peutModifier($employe));
        $this->assertFalse($service->peutAnnuler($employe));
    }
}
