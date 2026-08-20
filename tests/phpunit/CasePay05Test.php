<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-05-A1 — Échec d'acompte sans réservation confirmée. */
final class CasePay05Test extends TestCase
{
    public function test_CASE_PAY_05_A1_echec_acompte_sans_reservation(): void
    {
        $sortie = (new \App\Entity\Sortie())->setPlacesRestantes(4);
        $reservation = (new \App\Entity\Reservation())
            ->setSortie($sortie)->setNbAdultes(2)->setMontantTotal(260.0);

        $paiement = (new \App\Service\PaiementService())
            ->confirmerAcompte($reservation, 78.0, 'REF-PAY-05', false);

        $this->assertNull($paiement);
        $this->assertCount(0, $reservation->getPaiements());
        $this->assertNotSame('réservée', $reservation->getEtat());
        $this->assertNotSame('acompte payé', $reservation->getStatutPaiement());
        $this->assertSame(4, $sortie->getPlacesRestantes());
    }
}
