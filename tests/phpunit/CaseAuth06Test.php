<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-06 — Refus d'un mot de passe trop faible
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : ?
 */
final class CaseAuth06Test extends TestCase
{
    public function test_CASE_AUTH_06(): void
    {
        // Quand un visiteur propose un mot de passe trop faible
        $this->expectException(\App\Exception\MotDePasseInvalideException::class);
        (new \App\Service\CompteService())->creerCompte([
            'email' => 'paul.martin@email.fr',
            'mot_de_passe' => 'abc123',
        ]);
    }
}
