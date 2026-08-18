<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-01 — Un client peut remplir le formulaire de réservation
 * Spécification : SPEC-BOOK-01 — Critère d'acceptation : AC-01
 */
final class CaseBook01Test extends TestCase
{
    public function test_CASE_BOOK_01(): void
    {
        // Quand le client remplit et envoie le formulaire
        $reservation = (new \App\Service\ReservationService())->reserver([
            'nom' => 'Edouard', 'prenom' => 'Jean', 'email' => 'jean.edouard@email.fr',
            'nb_adultes' => 4, 'nb_enfants' => 1, 'type_sortie' => 'baleine',
            'date' => '2026-08-21', 'heure' => '10:00',
        ]);

        // Alors la réservation est enregistrée avec les bonnes informations
        $this->assertSame('Edouard', $reservation->getNom());
        $this->assertSame(4, $reservation->getNbAdultes());
        $this->assertSame(1, $reservation->getNbEnfants());
    }
}
