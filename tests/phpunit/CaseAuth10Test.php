<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-AUTH-10 — Authentification commune d'un utilisateur hotel. */
final class CaseAuth10Test extends TestCase
{
    public function test_CASE_AUTH_10_authentification_role_hotel(): void
    {
        $hotel = (new \App\Entity\Utilisateur())
            ->setEmail('hotel@example.test')
            ->setRole('hotel');
        $service = new \App\Service\CompteService();
        $service->enregistrerUtilisateur($hotel, 'Hotel974!');

        $connecte = $service->connecter('hotel@example.test', 'Hotel974!');

        $this->assertSame($hotel, $connecte);
        $this->assertSame('hotel', $connecte->getRole());
        $this->assertNull($connecte->getProfil());
        $this->assertFalse((new \App\Service\AutorisationService())->peutAccederEspaceGestion($connecte));
    }
}
