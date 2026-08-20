<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-05 — Refus d'une nouvelle annulation impossible. */
final class CaseCancelClient05Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_05_annulation_etat_terminal_refusee(): void
    {
        $depart = new \DateTimeImmutable('2026-08-18 09:00');
        foreach ([
            ['annulée', new \DateTimeImmutable('2026-08-17 09:00')],
            ['réalisée', new \DateTimeImmutable('2026-08-17 09:00')],
            ['réservée', new \DateTimeImmutable('2026-08-18 10:00')],
        ] as [$etat, $maintenant]) {
            $sortie = (new \App\Entity\Sortie())->setDate($depart);
            $reservation = (new \App\Entity\Reservation())
                ->setEtat($etat)->setMontantTotal(260.0)->setMontantEncaisse(78.0)->setSortie($sortie);
            try {
                (new \App\Service\AnnulationService())->calculerAnnulationClient($reservation, $maintenant);
                $this->fail('L’annulation devait être refusée.');
            } catch (\LogicException) {
                $this->assertCount(0, $reservation->getRemboursements());
            }
        }
    }
}
