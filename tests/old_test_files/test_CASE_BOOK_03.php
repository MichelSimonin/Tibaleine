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
        $reservation = new \App\Entity\Reservation();
        $reservation->setNom('Edouard');
        $reservation->setPrenom('Jean');
        $reservation->setNbAdultes(4);
        $reservation->setNbEnfants(1);
        (new \App\Service\ReservationService())->reserver($reservation);
        $notification = (new \App\Service\NotificationService())->envoyerConfirmation($reservation);

        // Alors il reçoit un email de confirmation
        $this->assertSame('confirmation', $notification->getType());
        $this->assertSame($reservation, $notification->getReservation());
    }
}
