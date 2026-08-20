<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-03-A1 — Remboursement unique des sommes encaissées. */
final class CaseCancelClient03Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_03_A1_remboursement_unique(): void
    {
        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-18 09:00'));
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('réservée')->setMontantTotal(260.0)->setMontantEncaisse(78.0)->setSortie($sortie);
        $service = new \App\Service\AnnulationService();
        $resultat = $service->calculerAnnulationClient($reservation, new \DateTimeImmutable('2026-08-08 09:00'));

        $premier = $service->confirmerRemboursement($reservation, $resultat->getTropPercu(), 'REF-CANCEL-03');
        $second = $service->confirmerRemboursement($reservation, $resultat->getTropPercu(), 'REF-CANCEL-03');

        $this->assertSame(78.0, $premier->getMontant());
        $this->assertSame($premier, $second);
        $this->assertCount(1, $reservation->getRemboursements());
        $this->assertSame('annulée', $reservation->getEtat());
    }
}
