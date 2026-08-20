<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-11 — Réservation créée à moins de H-12. */
final class CasePay11Test extends TestCase
{
    public function test_CASE_PAY_11_reservation_moins_h12(): void
    {
        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-22 10:00'));
        $reservation = (new \App\Entity\Reservation())->setSortie($sortie)->setStatutPaiement('acompte payé');
        $service = new \App\Service\PaiementService();

        $this->assertSame(['sur_place'], $service->modesSoldeDisponibles($reservation, new \DateTimeImmutable('2026-08-22 02:00')));
        $this->assertNull($service->creerLienSolde($reservation, new \DateTimeImmutable('2026-08-22 02:00')));
    }
}
