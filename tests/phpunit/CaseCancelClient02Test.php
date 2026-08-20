<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-02-A1 — Frais exactement à H-48. */
final class CaseCancelClient02Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_02_A1_frontiere_h48(): void
    {
        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-18 09:00'));
        $reservation = (new \App\Entity\Reservation())
            ->setEtat('réservée')->setMontantTotal(260.0)->setMontantEncaisse(78.0)->setSortie($sortie);

        $resultat = (new \App\Service\AnnulationService())
            ->calculerAnnulationClient($reservation, new \DateTimeImmutable('2026-08-16 09:00'));

        $this->assertSame(65.0, $resultat->getFrais());
        $this->assertSame(13.0, $resultat->getTropPercu());
        $this->assertSame(0.0, $resultat->getComplementDu());
    }
}
