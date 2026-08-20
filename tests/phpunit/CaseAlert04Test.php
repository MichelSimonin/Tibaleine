<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-ALERT-04 — Annulation définitive : notification simultanée « sans frais »
 * Spécification : SPEC-ALERT-01 — Critère d'acceptation : AC-02
 */
final class CaseAlert04Test extends TestCase
{
    public function test_CASE_ALERT_04(): void
    {
        // Étant donné une sortie avec 5 réservations et un avertissement déjà envoyé
        $sortie = new \App\Entity\Sortie();
        for ($i = 0; $i < 5; $i++) {
            $r = new \App\Entity\Reservation();
            $r->setEtat('payée');
            $sortie->addReservation($r);
        }

        // Quand l'administrateur confirme l'annulation définitive
        $notifications = (new \App\Service\NotificationService())
            ->envoyerAnnulation($sortie, new \DateTimeImmutable('2026-07-12 07:00'));

        // Alors les 5 clients sont prévenus au même moment, avec la mention « sans frais »
        $this->assertCount(5, $notifications);
        $first = $notifications[0]->getDateEnvoi();
        foreach ($notifications as $n) {
            $this->assertSame($first->format('U'), $n->getDateEnvoi()->format('U'));
            $this->assertStringContainsString('sans frais', $n->getContenu());
        }
    }
}
