<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-04 — Le nombre de places disponibles pour une activité se met à jour après le paiement d'une réservation
 * Spécification : SPEC-BOOK-01 — Critère d'acceptation : AC-04
 */
final class CaseBook04Test extends TestCase
{
    public function test_CASE_BOOK_04(): void
    {
        // Étant donné un créneau avec 6 places et une réservation de 5 personnes
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(6);
        $reservation = new \App\Entity\Reservation();
        $reservation->setSortie($sortie); $reservation->setNbAdultes(4); $reservation->setNbEnfants(1);

        // Quand le client paie
        (new \App\Service\PaiementService())->payer($reservation);

        // Alors les places restantes passent à 1
        $this->assertSame(1, $sortie->getPlacesRestantes());
    }
}
