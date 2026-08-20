<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-PRESTATAIRE-03-A1 — Remboursement intégral unique. */
final class CaseCancelPrestataire03Test extends TestCase
{
    public function test_CASE_CANCEL_PRESTATAIRE_03_A1_remboursement_unique(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('annulée')->setMontantTotal(260.0)->setMontantEncaisse(260.0);
        $service = new \App\Service\AnnulationService();
        $service->choisirApresAnnulationPrestataire($reservation, 'remboursement');

        $premier = $service->confirmerRemboursement($reservation, 260.0, 'REF-PRESTATAIRE-03');
        $second = $service->confirmerRemboursement($reservation, 260.0, 'REF-PRESTATAIRE-03');

        $this->assertSame($premier, $second);
        $this->assertCount(1, $reservation->getRemboursements());
        $this->assertSame('remboursement', $reservation->getChoixApresAnnulation());
    }
}
