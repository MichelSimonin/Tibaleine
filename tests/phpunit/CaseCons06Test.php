<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CONS-06 — Le client sans réservation voit un message dédié
 * Spécification : SPEC-CONS-01 — Critère d'acceptation : ?
 */
final class CaseCons06Test extends TestCase
{
    public function test_CASE_CONS_06(): void
    {
        // Étant donné un client sans aucune réservation
        $client = new \App\Entity\Utilisateur();
        $client->setRole('utilisateur');

        // Quand il consulte ses réservations
        $resultat = (new \App\Service\ConsultationService())->listerReservations($client, []);

        // Alors la liste est vide
        $this->assertCount(0, $resultat);
        $this->assertSame('aucune réservation', (new \App\Service\ConsultationService())->messageListeVide($resultat));
    }
}
