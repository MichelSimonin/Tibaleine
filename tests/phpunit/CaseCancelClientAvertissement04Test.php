<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-AVERTISSEMENT-04-A1 — Trace d'envoi réussi. */
final class CaseCancelClientAvertissement04Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_04_A1_trace_envoi_reussi(): void
    {
        $reservation = (new \App\Entity\Reservation())->setEtat('réservée');
        $service = new \App\Service\NotificationService();
        $notification = $service->envoyerAvertissementAuClient($reservation, new \DateTimeImmutable('2026-07-11 18:00'));

        $this->assertCount(1, $service->getTracesEnvoi());
        $this->assertSame($notification, $service->getTracesEnvoi()[0]);
        $this->assertSame($reservation, $notification->getReservation());
        $this->assertSame('2026-07-11 18:00:00', $notification->getDateEnvoi()?->format('Y-m-d H:i:s'));
    }
}
