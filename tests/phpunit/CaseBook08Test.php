<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-08-A1 — Notification unique du patron après l'acompte. */
final class CaseBook08Test extends TestCase
{
    public function test_CASE_BOOK_08_A1_notification_patron_apres_acompte(): void
    {
        $reservation = (new \App\Entity\Reservation())->setMontantTotal(260.0);
        (new \App\Service\PaiementService())->confirmerAcompte($reservation, 78.0, 'ACOMPTE-BOOK-08');

        $notifications = (new \App\Service\NotificationService())->notifierPatron($reservation);

        $this->assertSame('réservée', $reservation->getEtat());
        $this->assertSame('acompte payé', $reservation->getStatutPaiement());
        $this->assertCount(1, $notifications);
        $this->assertSame($reservation, $notifications[0]->getReservation());
        $this->assertSame('patron', $notifications[0]->getDestinataire());
    }
}
