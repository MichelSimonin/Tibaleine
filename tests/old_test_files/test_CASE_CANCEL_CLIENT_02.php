<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-CLIENT-02 — Annulation client à entre 48h et 7 jours
 * Spécification : SPEC-CANCEL-CLIENT-01 — Critère d'acceptation : AC-04
 */
final class CaseCancelClient02Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_02(): void
    {
        // Étant donné une réservation payée de 260 €, départ le 18 août à 09h00
        $sortie = new \App\Entity\Sortie();
        $sortie->setDate(new \DateTimeImmutable('2026-08-18 09:00'));
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');
        $reservation->setMontantTotal(260.0);
        $reservation->setSortie($sortie);

        // Quand le client annule entre 48 h et 7 jours avant le départ
        $remboursement = (new \App\Service\AnnulationService())
            ->annulerClient($reservation, new \DateTimeImmutable('2026-08-14 09:00'));

        // Alors 25 % sont retenus et 195 € remboursés
        $this->assertSame(195.0, $remboursement->getMontant());
    }
}
