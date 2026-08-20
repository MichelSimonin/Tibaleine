<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-06 — Le blocage temporaire des places pendant la saisie du formulaire 
 * Spécification : SPEC-BOOK-03 — Critère d'acceptation : AC-01
 */
final class CaseBook06Test extends TestCase
{
    public function test_CASE_BOOK_06(): void
    {
        // Étant donné 2 places restantes
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(2);
        $service = new \App\Service\ReservationService();

        // Quand le client bloque les 2 places à 17:45
        $service->bloquerPlace($sortie, 2, new \DateTimeImmutable('2026-08-22 17:45'));
        $this->assertSame(0, $sortie->getPlacesRestantes());
        $service->libererSiExpire($sortie, new \DateTimeImmutable('2026-08-22 17:59:59'));
        $this->assertSame(0, $sortie->getPlacesRestantes());

        // Alors elles sont libérées après 15 minutes
        $service->libererSiExpire($sortie, new \DateTimeImmutable('2026-08-22 18:00'));
        $this->assertSame(2, $sortie->getPlacesRestantes());
    }
}
