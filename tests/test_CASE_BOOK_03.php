<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-03—envoie-retour-mail Un client peut envoyer le formulaire et recevoir un retour par mail
 * Spécification : SPEC-BOOK-01 — Critère d'acceptation : AC-02
 */
final class CaseBook03Test extends TestCase
{
    public function test_CASE_BOOK_03(): void
    {
        // Quand le client envoie le formulaire
        $reservation = (new \App\Service\ReservationService())->reserver([
            'nom' => 'Edouard', 'prenom' => 'Jean', 'email' => 'edouardo@email.fr',
            'nb_adultes' => 4, 'nb_enfants' => 1, 'type_sortie' => 'baleine',
        ]);
        $notification = (new \App\Service\NotificationService())->envoyerConfirmation($reservation);

        // Alors il reçoit un email de confirmation
        $this->assertSame('confirmation', $notification->getType());
        $this->assertSame($reservation, $notification->getReservation());
    }
}
