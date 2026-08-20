<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-02-A1 — Réservation immédiate par un hôtel. */
final class CaseBook02Test extends TestCase
{
    public function test_CASE_BOOK_02_A1_reservation_hotel_immediate(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $sortie = (new \App\Entity\Sortie())->setPlacesRestantes(4);

        $reservation = (new \App\Service\ReservationService())->reserverHotel($hotel, $sortie, 4);
        $notifications = (new \App\Service\NotificationService())->notifierPatron($reservation);

        $this->assertSame('réservée', $reservation->getEtat());
        $this->assertSame('en attente de paiement', $reservation->getStatutPaiement());
        $this->assertFalse($reservation->paiementAcompteRequis());
        $this->assertCount(0, $reservation->getPaiements());
        $this->assertSame(0, $sortie->getPlacesRestantes());
        $this->assertCount(1, $notifications);
    }
}
