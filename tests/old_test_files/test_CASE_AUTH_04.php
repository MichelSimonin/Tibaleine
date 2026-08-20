<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-AUTH-04 — Connexion sans mot de passe via un lien email à usage unique
 * Spécification : SPEC-AUTH-01 — Critère d'acceptation : AC-02
 */
final class CaseAuth04Test extends TestCase
{
    public function test_CASE_AUTH_04(): void
    {
        // Étant donné un compte sans mot de passe
        $service = new \App\Service\CompteService();

        // Quand le client demande un lien de connexion à usage unique
        $lien = $service->genererLienConnexion('marie.dupont@email.fr');
        $service->connecterParLien($lien); // première utilisation : OK

        // Alors la réutilisation du même lien est refusée
        $this->expectException(\App\Exception\LienInvalideException::class);
        $service->connecterParLien($lien);
    }
}
