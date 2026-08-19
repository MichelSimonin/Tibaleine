<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-07— La place est libérée si le paiement n'est pas fait sous 15 minutes. 
 * Spécification : SPEC-BOOK-03 — Critère d'acceptation : AC-04
 */
final class CaseBook07Test extends TestCase
{
    public function test_CASE_BOOK_07(): void
    {
        // Étant donné 2 places restantes, bloquées au passage au paiement à 17:50
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(2);
        $service = new \App\Service\ReservationService();
        $service->bloquerPlace($sortie, 2, new \DateTimeImmutable('2026-08-22 17:50'));

        // Quand le client abandonne sans payer et que 15 minutes s'écoulent
        $service->libererSiExpire($sortie, new \DateTimeImmutable('2026-08-22 18:05'));

        // Alors les places redeviennent disponibles
        $this->assertSame(2, $sortie->getPlacesRestantes());
    }
}
