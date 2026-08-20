<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-08 — Le patron reçoit une notification de réservation
 * Spécification : SPEC-BOOK-01 — Critère d'acceptation : AC-3
 */
final class CaseBook08Test extends TestCase
{
    public function test_CASE_BOOK_08(): void
    {
        // Étant donné un créneau de sortie baleine le 21 août 2026 à 10h avec 6 places restantes
        $sortie = new \App\Entity\Sortie();
        $sortie->setDate(new \DateTimeImmutable('2026-08-21 10:00'));
        $sortie->setPlacesRestantes(6);

        // Et Jean Edouard réserve ce créneau pour 5 personnes, dont 1 enfant
        $reservation = new \App\Entity\Reservation();
        $reservation->setSortie($sortie);
        $reservation->setNom('Edouard');
        $reservation->setPrenom('Jean');
        $reservation->setNbAdultes(4);
        $reservation->setNbEnfants(1);

        // Quand Jean confirme sa réservation et que le paiement réussit
        (new \App\Service\ReservationService())->reserver($reservation);
        (new \App\Service\PaiementService())->payer($reservation);
        $notifications = (new \App\Service\NotificationService())->notifierPatron($reservation);

        // Alors la réservation est enregistrée avec le statut « payée »
        $this->assertSame('payée', $reservation->getEtat());

        // Et un seul SMS de notification est envoyé au patron
        $sms = array_values(array_filter(
            $notifications,
            fn ($n) => $n->getCanal() === 'sms' && $n->getDestinataire() === 'patron'
        ));
        $this->assertCount(1, $sms);

        // Et une seule notification apparaît dans l'espace administrateur du patron
        $admin = array_values(array_filter(
            $notifications,
            fn ($n) => $n->getCanal() === 'admin' && $n->getDestinataire() === 'patron'
        ));
        $this->assertCount(1, $admin);
    }
}
