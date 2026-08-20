<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-09 — Concurrence sur la dernière place. */
final class CaseBook09Test extends TestCase
{
    public function test_CASE_BOOK_09_concurrence_derniere_place(): void
    {
        $sortie = (new \App\Entity\Sortie())->setPlacesRestantes(1);
        $premiere = (new \App\Entity\Reservation())->setSortie($sortie)->setNbAdultes(1);
        $seconde = (new \App\Entity\Reservation())->setSortie($sortie)->setNbAdultes(1);
        $service = new \App\Service\ReservationService();

        $this->assertTrue($service->reserverSiDisponible($premiere));
        $this->assertFalse($service->reserverSiDisponible($seconde));
        $this->assertSame(0, $sortie->getPlacesRestantes());
        $this->assertCount(1, $sortie->getReservations());
    }
}
