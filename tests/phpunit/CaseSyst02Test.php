<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-SYST-02 — Une panne d'un service externe ne bloque pas l'application
 * Spécification : SPEC-SYST-01 — Critère d'acceptation : AC-02
 */
final class CaseSyst02Test extends TestCase
{
    public function test_CASE_SYST_02(): void
    {
        $service = new \App\Service\NotificationService();
        $service->simulerIndisponibiliteSms(true);
        $sortie = new \App\Entity\Sortie();
        $sortie->addReservation((new \App\Entity\Reservation())->setEtat('payée'));
        $notifications = $service->envoyerAvertissement($sortie, new \DateTimeImmutable('2026-07-11 18:00'));
        $this->assertCount(1, $notifications);
        $this->assertSame('email', $notifications[0]->getCanal());
    }
}
