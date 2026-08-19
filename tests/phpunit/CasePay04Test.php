<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-PAY-04 — La place est libérée après 15 minutes sans paiement
 * Spécification : SPEC-PAY-01 — Critère d'acceptation : AC-04
 */
final class CasePay04Test extends TestCase
{
    public function test_CASE_PAY_04(): void
    {
        // Étant donné une place bloquée à l'arrivée au paiement
        $sortie = new \App\Entity\Sortie();
        $sortie->setPlacesRestantes(0);
        $service = new \App\Service\PaiementService();

        // Quand 15 minutes s'écoulent sans paiement
        $service->libererSiExpire($sortie, new \DateTimeImmutable('2026-08-18 10:16:00'));

        // Alors la place redevient disponible
        $this->assertSame(1, $sortie->getPlacesRestantes());
    }
}
