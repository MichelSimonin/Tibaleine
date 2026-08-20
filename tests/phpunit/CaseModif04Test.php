<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-MODIF-04-A1 — Suppression et remboursement du trop-perçu. */
final class CaseModif04Test extends TestCase
{
    public function test_CASE_MODIF_04_A1_suppression_trop_percu(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setMontantTotal(260.0)->setMontantEncaisse(200.0)->setNbAdultes(3);
        (new \App\Service\ReservationService())->supprimerParticipant($reservation, 1, 160.0);
        $annulation = new \App\Service\AnnulationService();

        $premier = $annulation->confirmerRemboursement($reservation, $reservation->getTropPercu(), 'REMBOURSEMENT-MODIF-04');
        $second = $annulation->confirmerRemboursement($reservation, $reservation->getTropPercu(), 'REMBOURSEMENT-MODIF-04');

        $this->assertSame(0.0, $reservation->getSoldeRestant());
        $this->assertSame(40.0, $reservation->getTropPercu());
        $this->assertSame(40.0, $premier->getMontant());
        $this->assertSame($premier, $second);
        $this->assertCount(1, $reservation->getRemboursements());
    }
}
