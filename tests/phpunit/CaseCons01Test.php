<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CONS-01-A1 — Le client voit séparément état et statut. */
final class CaseCons01Test extends TestCase
{
    public function test_CASE_CONS_01_A1_client_voit_etat_statut(): void
    {
        $client = (new \App\Entity\Utilisateur())->setRole('utilisateur');
        $reservation = (new \App\Entity\Reservation())
            ->setUtilisateur($client)->setEtat('réservée')->setStatutPaiement('acompte payé');
        $etrangere = (new \App\Entity\Reservation())->setUtilisateur(new \App\Entity\Utilisateur());

        $resultat = (new \App\Service\ConsultationService())
            ->listerReservations($client, [$reservation, $etrangere]);

        $this->assertCount(1, $resultat);
        $this->assertSame('réservée', $resultat[0]->getEtat());
        $this->assertSame('acompte payé', $resultat[0]->getStatutPaiement());
    }
}
