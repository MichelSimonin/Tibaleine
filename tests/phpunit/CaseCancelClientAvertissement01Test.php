<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-CLIENT-AVERTISSEMENT-01 — Annulation client pendant la phase d'avertissement (remboursement intégral)
 * Spécification : SPEC-CANCEL-CLIENT-AVERTISSEMENT-03 — Critère d'acceptation : AC-03
 */
final class CaseCancelClientAvertissement01Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_01(): void
    {
        // Étant donné une réservation payée de 260 € et un avertissement reçu
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $reservation->setMontantTotal(260.0);
        $reservation->setAvertissementRecu(true);

        // Quand le client annule pendant la phase d'avertissement
        $remboursement = (new \App\Service\AnnulationService())
            ->annulerApresAvertissement($reservation);

        // Alors il est remboursé intégralement
        $this->assertSame(260.0, $remboursement->getMontant());
        $this->assertSame('annulée', $reservation->getEtat());
    }
}
