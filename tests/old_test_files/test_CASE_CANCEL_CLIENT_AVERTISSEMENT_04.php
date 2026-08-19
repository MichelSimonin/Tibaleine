<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-CLIENT-AVERTISSEMENT-04 — Trace de réception de l'avertissement
 * Spécification : SPEC-CANCEL-CLIENT-AVERTISSEMENT-03 — Critère d'acceptation : AC-01
 */
final class CaseCancelClientAvertissement04Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_04(): void
    {
        // Étant donné un client avec une réservation payée
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');

        // Quand le prestataire envoie l'avertissement par SMS et mail
        $notification = (new \App\Service\NotificationService())
            ->envoyerAvertissementAuClient($reservation, new \DateTimeImmutable('2026-07-11 18:00'));

        // Alors une notification « avertissement » horodatée est liée à la réservation
        $this->assertSame('avertissement', $notification->getType());
        $this->assertSame($reservation, $notification->getReservation());
        $this->assertSame('2026-07-11 18:00:00', $notification->getDateEnvoi()->format('Y-m-d H:i:s'));
    }
}
