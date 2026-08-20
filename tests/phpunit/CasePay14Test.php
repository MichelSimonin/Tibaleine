<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-14 — Aucun lien de solde avant H-24. */
final class CasePay14Test extends TestCase
{
    public function test_CASE_PAY_14_aucun_lien_solde_avant_h24(): void
    {
        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-22 10:00'));
        $reservation = (new \App\Entity\Reservation())->setSortie($sortie)->setStatutPaiement('acompte payé');
        $service = new \App\Service\PaiementService();

        $this->assertNull($service->creerLienSolde($reservation, new \DateTimeImmutable('2026-08-21 09:59')));
        $this->assertNotNull($service->creerLienSolde($reservation, new \DateTimeImmutable('2026-08-21 10:00')));
    }
}
