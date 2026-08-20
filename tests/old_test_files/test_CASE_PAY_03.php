<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-PAY-03 — Les places sont mises à jour après le paiement
 * Spécification : SPEC-PAY-01 — Critère d'acceptation : AC-03
 */
final class CasePay03Test extends TestCase
{
    public function test_CASE_PAY_03(): void
    {
        // Étant donné un créneau avec 6 places restantes et une réservation de 5 personnes
        $sortie = new \App\Entity\Sortie();
        $sortie->setPlacesRestantes(6);
        $reservation = new \App\Entity\Reservation();
        $reservation->setSortie($sortie);
        $reservation->setNbAdultes(4);
        $reservation->setNbEnfants(1);

        // Quand le client paie
        (new \App\Service\PaiementService())->payer($reservation);

        // Alors les places restantes passent à 1
        $this->assertSame(1, $sortie->getPlacesRestantes());
    }
}
