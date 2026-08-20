<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-PRESTATAIRE-04 — Report accepté sans remboursement. */
final class CaseCancelPrestataire04Test extends TestCase
{
    public function test_CASE_CANCEL_PRESTATAIRE_04_report_sans_remboursement(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('annulée')->setStatutPaiement('acompte payé')->setMontantEncaisse(78.0);
        $nouvelleSortie = (new \App\Entity\Sortie())->setPlacesRestantes(4);
        $service = new \App\Service\AnnulationService();
        $service->choisirApresAnnulationPrestataire($reservation, 'report');

        $service->reporter($reservation, $nouvelleSortie);

        $this->assertSame('réservée', $reservation->getEtat());
        $this->assertSame('acompte payé', $reservation->getStatutPaiement());
        $this->assertSame(78.0, $reservation->getMontantEncaisse());
        $this->assertCount(0, $reservation->getRemboursements());
        $this->assertSame($nouvelleSortie, $reservation->getSortie());
    }
}
