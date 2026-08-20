<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-DISP-04 — Badge « nouvelle place disponible » après expiration du délai de paiement
 * Spécification : SPEC-DISP-01 — Critère d'acceptation : AC-03
 */
final class CaseDisp04Test extends TestCase
{
    public function test_CASE_DISP_04(): void
    {
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(0);
        $sortie->setPlacesRestantes(1);
        $service = new \App\Service\ReservationService();
        $service->bloquerPlace($sortie, 1, new \DateTimeImmutable('2026-08-20 07:00'));
        $service->libererSiExpire($sortie, new \DateTimeImmutable('2026-08-20 07:15'));
        $this->assertSame(1, $sortie->getPlacesRestantes());
        $this->assertTrue($sortie->badgeNouvellePlace());
    }
}
