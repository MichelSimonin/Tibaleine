<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-CLIENT-01 — Annulation client à moins de 48 heures
 * Spécification : SPEC-CANCEL-CLIENT-01 — Critère d'acceptation : AC-03
 */
final class CaseCancelClient01Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_01(): void
    {
        // Étant donné une réservation payée de 260 €, départ le 18 août à 09h00
        $sortie = new \App\Entity\Sortie();
        $sortie->setDate(new \DateTimeImmutable('2026-08-18 09:00'));
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $reservation->setMontantTotal(260.0);
        $reservation->setSortie($sortie);

        // Quand le client annule 24 h avant le départ
        $remboursement = (new \App\Service\AnnulationService())
            ->annulerClient($reservation, new \DateTimeImmutable('2026-08-17 09:00'));

        // Alors 50 % sont retenus et 130 € remboursés
        $this->assertSame(130.0, $remboursement->getMontant());
        $this->assertSame('annulée', $reservation->getEtat());
    }
}
