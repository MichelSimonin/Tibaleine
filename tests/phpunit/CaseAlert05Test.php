<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-ALERT-05 — L'hôtel partenaire n'est pas notifié par SMS/mail
 * Spécification : SPEC-ALERT-01 — Critère d'acceptation : ?
 */
final class CaseAlert05Test extends TestCase
{
    public function test_CASE_ALERT_05(): void
    {
        // Étant donné un hôtel (4 places) et 3 clients particuliers sur le même créneau
        $sortie = new \App\Entity\Sortie();
        $hotel = new \App\Entity\Reservation();
        $hotel->setProfil('hotel');
        $sortie->addReservation($hotel);
        for ($i = 0; $i < 3; $i++) {
            $sortie->addReservation((new \App\Entity\Reservation())->setProfil('client'));
        }

        // Quand l'administrateur confirme l'annulation définitive
        $notifications = (new \App\Service\NotificationService())
            ->envoyerAnnulation($sortie, new \DateTimeImmutable('2026-07-12 07:00'));

        // Alors seuls les 3 clients particuliers sont notifiés par SMS/mail
        $this->assertCount(3, $notifications);
        $this->assertTrue($sortie->hotelAAppeler());
    }
}
