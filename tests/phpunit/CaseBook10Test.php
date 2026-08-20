<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-10 — Privatisation refusée pour un hôtel. */
final class CaseBook10Test extends TestCase
{
    public function test_CASE_BOOK_10_privatisation_refusee_hotel(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $sortie = (new \App\Entity\Sortie())->setPlacesRestantes(6);

        try {
            (new \App\Service\ReservationService())->reserverHotel($hotel, $sortie, 6, true);
            $this->fail('La privatisation par un hôtel devait être refusée.');
        } catch (\LogicException) {
            $this->assertSame(6, $sortie->getPlacesRestantes());
            $this->assertCount(0, $sortie->getReservations());
        }
    }
}
