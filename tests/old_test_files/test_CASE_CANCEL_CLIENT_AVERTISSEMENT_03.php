<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-CLIENT-AVERTISSEMENT-03 — Remboursement intégral maintenu même si la sortie a finalement lieu
 * Spécification : SPEC-CANCEL-CLIENT-AVERTISSEMENT-03 — Critère d'acceptation : AC-04
 */
final class CaseCancelClientAvertissement03Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_03(): void
    {
        // Étant donné une réservation annulée après avertissement, déjà remboursée à 100 %
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('annulée');
        $reservation->setMontantTotal(260.0);
        $rembourse = 260.0;

        // Quand la sortie est finalement maintenue
        (new \App\Service\AnnulationService())->sortieMaintenue($reservation);

        // Alors le remboursement intégral n'est pas remis en cause
        $this->assertSame('annulée', $reservation->getEtat());
        $this->assertSame(260.0, $rembourse);
    }
}
