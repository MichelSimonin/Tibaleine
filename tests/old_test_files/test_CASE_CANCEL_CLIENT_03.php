<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-CLIENT-03 — Annulation client à plus de 7 jours
 * Spécification : SPEC-CANCEL-CLIENT-01 — Critère d'acceptation : AC-05
 */
final class CaseCancelClient03Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_03(): void
    {
        // Étant donné une réservation payée de 260 €, départ le 18 août à 09h00
        $sortie = new \App\Entity\Sortie();
        $sortie->setDate(new \DateTimeImmutable('2026-08-18 09:00'));
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $reservation->setMontantTotal(260.0);
        $reservation->setSortie($sortie);

        // Quand le client annule plus de 7 jours avant le départ
        $remboursement = (new \App\Service\AnnulationService())
            ->annulerClient($reservation, new \DateTimeImmutable('2026-08-08 09:00'));

        // Alors 0 % sont retenus et 260 € remboursés
        $this->assertSame(260.0, $remboursement->getMontant());
    }
}
