<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-ALERT-06 — Panne du service SMS lors d'un avertissement
 * Spécification : SPEC-ALERT-01 — Critère d'acceptation : ?
 */
final class CaseAlert06Test extends TestCase
{
    public function test_CASE_ALERT_06(): void
    {
        // Étant donné un service SMS indisponible
        $sortie = new \App\Entity\Sortie();
        $sortie->addReservation((new \App\Entity\Reservation())->setEtat('payée'));
        $service = new \App\Service\NotificationService();
        $service->simulerIndisponibiliteSms(true);

        // Quand l'administrateur déclenche l'avertissement
        $notifications = $service->envoyerAvertissement($sortie, new \DateTimeImmutable('2026-07-11 18:00'));

        // Alors l'application n'est pas bloquée et le mail prend le relais
        $this->assertCount(1, $notifications);
        $this->assertSame('email', $notifications[0]->getCanal());
    }
}
