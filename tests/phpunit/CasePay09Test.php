<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-09 — Lien du solde entre H-24 et H-12. */
final class CasePay09Test extends TestCase
{
    public function test_CASE_PAY_09_lien_solde_h24_h12(): void
    {
        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-22 10:00'));
        $reservation = (new \App\Entity\Reservation())
            ->setSortie($sortie)->setMontantTotal(260.0)->setMontantEncaisse(78.0)
            ->setEtat('réservée')->setStatutPaiement('acompte payé');
        $service = new \App\Service\PaiementService();

        $this->assertNotNull($service->creerLienSolde($reservation, new \DateTimeImmutable('2026-08-21 10:00')));
        $service->commencerPaiementSolde($reservation, 'SOLDE-PAY-09', new \DateTimeImmutable('2026-08-21 21:59'));
        $this->assertNull($service->creerLienSolde($reservation, new \DateTimeImmutable('2026-08-21 22:00')));

        $premier = $service->confirmerSolde($reservation, 'SOLDE-PAY-09');
        $second = $service->confirmerSolde($reservation, 'SOLDE-PAY-09');
        $this->assertSame($premier, $second);
        $this->assertSame('intégralement payé', $reservation->getStatutPaiement());
        $this->assertSame(1, $service->nombreOperations());
    }
}
