<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-CLIENT-AVERTISSEMENT-02 — Annulation avant l'envoi de l'avertissement (barème classique)
 * Spécification : SPEC-CANCEL-CLIENT-AVERTISSEMENT-03 — Critère d'acceptation : ?
 */
final class CaseCancelClientAvertissement02Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_02(): void
    {
        // Étant donné une réservation payée de 260 €, sans avertissement reçu
        $sortie = new \App\Entity\Sortie();
        $sortie->setDate(new \DateTimeImmutable('2026-08-18 09:00'));
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('réservée');
        $reservation->setMontantTotal(260.0);
        $reservation->setMontantEncaisse(78.0);
        $reservation->setSortie($sortie);
        $reservation->setAvertissementRecu(false);

        // Quand le client annule 24 h avant le départ (sans avertissement)
        $resultat = (new \App\Service\AnnulationService())
            ->calculerAnnulationClient($reservation, new \DateTimeImmutable('2026-08-17 09:00'));

        // Alors le barème classique s'applique : 130 € de frais et 52 € restant dus
        $this->assertSame(130.0, $resultat->getFrais());
        $this->assertSame(52.0, $resultat->getComplementDu());
    }
}
