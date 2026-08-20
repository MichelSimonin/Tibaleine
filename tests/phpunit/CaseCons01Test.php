<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CONS-01 — Le client ne voit que ses propres réservations
 * Spécification : SPEC-CONS-01 — Critère d'acceptation : AC-01
 */
final class CaseCons01Test extends TestCase
{
    public function test_CASE_CONS_01(): void
    {
        // Étant donné un client avec 2 réservations et 3 autres réservations étrangères
        $client = new \App\Entity\Utilisateur();
        $client->setRole('utilisateur');
        $r1 = new \App\Entity\Reservation(); $r1->setUtilisateur($client);
        $r2 = new \App\Entity\Reservation(); $r2->setUtilisateur($client);
        $r3 = new \App\Entity\Reservation(); $r3->setUtilisateur(new \App\Entity\Utilisateur());

        // Quand il consulte ses réservations
        $resultat = (new \App\Service\ConsultationService())->listerReservations($client, [$r1, $r2, $r3]);

        // Alors il ne voit que ses 2 réservations
        $this->assertCount(2, $resultat);
    }
}
