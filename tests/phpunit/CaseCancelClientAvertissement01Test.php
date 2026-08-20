<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-AVERTISSEMENT-01-A1 — Remboursement de l'acompte. */
final class CaseCancelClientAvertissement01Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_01_A1_remboursement_acompte(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('réservée')->setMontantTotal(260.0)->setMontantEncaisse(78.0)->setAvertissementRecu(true);
        $service = new \App\Service\AnnulationService();
        $montant = $service->calculerApresAvertissement($reservation);

        $premier = $service->confirmerRemboursement($reservation, $montant, 'REF-AVERT-01');
        $second = $service->confirmerRemboursement($reservation, $montant, 'REF-AVERT-01');

        $this->assertSame(78.0, $premier->getMontant());
        $this->assertSame($premier, $second);
        $this->assertCount(1, $reservation->getRemboursements());
    }
}
