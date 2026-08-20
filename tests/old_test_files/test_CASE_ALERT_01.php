<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-ALERT-01 — Envoi de l'avertissement météo à 18h aux clients concernés
 * Spécification : SPEC-ALERT-01 — Critère d'acceptation : AC-01
 */
final class CaseAlert01Test extends TestCase
{
    public function test_CASE_ALERT_01(): void
    {
        // Étant donné une sortie avec 5 réservations payées
        $sortie = new \App\Entity\Sortie();
        $sortie->setDate(new \DateTimeImmutable('2026-07-12 10:00'));
        for ($i = 0; $i < 5; $i++) {
            $r = new \App\Entity\Reservation();
            $r->setEtat('payée');
            $sortie->addReservation($r);
        }

        // Quand l'administrateur déclenche l'avertissement le 11 juillet à 18:00
        $notifications = (new \App\Service\NotificationService())
            ->envoyerAvertissement($sortie, new \DateTimeImmutable('2026-07-11 18:00'));

        // Alors les 5 clients reçoivent un avertissement
        $this->assertCount(5, $notifications);
        $this->assertSame('avertissement', $notifications[0]->getType());
        $this->assertSame('2026-07-11 18:00:00', $notifications[0]->getDateEnvoi()->format('Y-m-d H:i:s'));
    }
}
