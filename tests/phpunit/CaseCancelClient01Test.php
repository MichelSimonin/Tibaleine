<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-01-A1 — Complément dû à moins de 48 heures. */
final class CaseCancelClient01Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_01_A1_complement_moins_48h(): void
    {
        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-18 09:00'));
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('réservée')->setMontantTotal(260.0)->setMontantEncaisse(78.0)->setSortie($sortie);

        $resultat = (new \App\Service\AnnulationService())
            ->calculerAnnulationClient($reservation, new \DateTimeImmutable('2026-08-17 09:00'));

        $this->assertSame(130.0, $resultat->getFrais());
        $this->assertSame(52.0, $resultat->getComplementDu());
        $this->assertNotNull($resultat->getLienPaiement());
        $this->assertSame('annulée', $reservation->getEtat());
    }
}
