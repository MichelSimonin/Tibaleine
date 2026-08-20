<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-03-A1 — Email après confirmation de l'acompte. */
final class CaseBook03Test extends TestCase
{
    public function test_CASE_BOOK_03_A1_email_apres_acompte(): void
    {
        $reservation = (new \App\Entity\Reservation())->setMontantTotal(300.0);
        $paiement = (new \App\Service\PaiementService())->confirmerAcompte($reservation, 90.0, 'ACOMPTE-BOOK-03');
        $notification = (new \App\Service\NotificationService())->envoyerConfirmation($reservation);

        $this->assertSame(90.0, $paiement?->getMontant());
        $this->assertSame('réservée', $reservation->getEtat());
        $this->assertSame('acompte payé', $reservation->getStatutPaiement());
        $this->assertSame('confirmation', $notification->getType());
        $this->assertSame($reservation, $notification->getReservation());
    }
}
