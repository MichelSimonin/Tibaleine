<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-ALERT-02 — Alerte site pour un client réservant après l'avertissement de 18h
 * Spécification : SPEC-ALERT-01 — Critère d'acceptation : AC-03
 */
final class CaseAlert02Test extends TestCase
{
    public function test_CASE_ALERT_02(): void
    {
        // Étant donné une sortie déjà sous avertissement
        $sortie = new \App\Entity\Sortie();
        $sortie->setAvertissementEnvoye(new \DateTimeImmutable('2026-07-11 18:00'));

        // Quand un nouveau client réserve le 11 juillet à 20:00
        $reservation = new \App\Entity\Reservation();
        $reservation->setSortie($sortie);
        $notifications = (new \App\Service\NotificationService())
            ->notifierNouveauClient($reservation, new \DateTimeImmutable('2026-07-11 20:00'));

        // Alors il ne reçoit ni SMS ni mail, mais l'alerte est visible sur le site
        $this->assertCount(0, $notifications);
        $this->assertTrue($sortie->alerteAffichee());
    }
}
