<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-PRESTATAIRE-02-A1 — Choix explicite et exclusif. */
final class CaseCancelPrestataire02Test extends TestCase
{
    public function test_CASE_CANCEL_PRESTATAIRE_02_A1_choix_exclusif(): void
    {
        $reservation = (new \App\Entity\Reservation())->setEtat('annulée');
        $service = new \App\Service\AnnulationService();
        $service->choisirApresAnnulationPrestataire($reservation, 'remboursement');

        try {
            $service->choisirApresAnnulationPrestataire($reservation, 'report');
            $this->fail('Les deux choix ne doivent pas pouvoir être cumulés.');
        } catch (\LogicException) {
            $this->assertSame('remboursement', $reservation->getChoixApresAnnulation());
        }
    }
}
