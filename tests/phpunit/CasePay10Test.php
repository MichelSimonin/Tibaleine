<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-10 — Réservation créée entre H-24 et H-12. */
final class CasePay10Test extends TestCase
{
    public function test_CASE_PAY_10_reservation_entre_h24_h12(): void
    {
        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-22 10:00'));
        $reservation = (new \App\Entity\Reservation())->setSortie($sortie)->setStatutPaiement('acompte payé');

        $modes = (new \App\Service\PaiementService())
            ->modesSoldeDisponibles($reservation, new \DateTimeImmutable('2026-08-21 16:00'));

        $this->assertSame(['en_ligne', 'sur_place'], $modes);
    }
}
