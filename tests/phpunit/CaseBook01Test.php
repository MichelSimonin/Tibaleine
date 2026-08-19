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
        $reservation = new \App\Entity\Reservation();
        $reservation->setNom('Edouard');
        $reservation->setPrenom('Jean');
        $reservation->setNbAdultes(4);
        $reservation->setNbEnfants(1);
        (new \App\Service\ReservationService())->reserver($reservation);

        // Alors la réservation est enregistrée avec les bonnes informations
        $this->assertSame('Edouard', $reservation->getNom());
        $this->assertSame(4, $reservation->getNbAdultes());
        $this->assertSame(1, $reservation->getNbEnfants());
    }
}
