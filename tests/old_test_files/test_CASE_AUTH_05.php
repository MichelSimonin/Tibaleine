<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-05 — Refus de création si l'email est déjà utilisé
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : ?
 */
final class CaseAuth05Test extends TestCase
{
    public function test_CASE_AUTH_05(): void
    {
        // Étant donné un compte existant avec cet email
        $service = new \App\Service\CompteService();
        $service->creerCompte(['email' => 'jean.edouard@email.fr']);

        // Quand un visiteur tente de créer un compte avec le même email
        $this->expectException(\App\Exception\EmailDejaUtiliseException::class);
        $service->creerCompte(['email' => 'jean.edouard@email.fr']);
    }
}
