<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-PRESTATAIRE-03-client-cancel Remboursement des clients après une annulation suite à une avertissement du prestataire
 * Spécification : SPEC-CANCEL-PRESTATAIRE-02 — Critère d'acceptation : AC-04
 */
final class CaseCancelPrestataire03Test extends TestCase
{
    public function test_CASE_CANCEL_PRESTATAIRE_03(): void
    {
        // Étant donné une réservation payée après avertissement du prestataire
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $reservation->setMontantTotal(260.0);
        $reservation->setAvertissementRecu(true);

        // Quand le client annule le soir même
        $remboursement = (new \App\Service\AnnulationService())
            ->annulerApresAvertissement($reservation);

        // Alors il est remboursé intégralement
        $this->assertSame(260.0, $remboursement->getMontant());
        $this->assertSame('annulée', $reservation->getEtat());
    }
}
