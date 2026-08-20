<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-ALERT-03 — Message d'avertissement personnalisé et bilingue (FR/EN)
 * Spécification : SPEC-ALERT-01 — Critère d'acceptation : AC-04
 */
final class CaseAlert03Test extends TestCase
{
    public function test_CASE_ALERT_03(): void
    {
        // Étant donné un client francophone et un client anglophone
        $sortie = new \App\Entity\Sortie();
        $fr = new \App\Entity\Reservation();
        $fr->setLangueClient('fr');
        $en = new \App\Entity\Reservation();
        $en->setLangueClient('en');
        $sortie->addReservation($fr);
        $sortie->addReservation($en);

        // Quand l'administrateur personnalise le message et déclenche l'envoi
        $notifications = (new \App\Service\NotificationService())
            ->envoyerAvertissementPersonnalise($sortie, 'risque de forte houle', new \DateTimeImmutable('2026-07-11 18:00'));

        // Alors chacun reçoit le message dans sa langue
        $langues = array_map(fn ($n) => $n->getLangue(), $notifications);
        sort($langues);
        $this->assertSame(['en', 'fr'], $langues);
        foreach ($notifications as $notification) {
            $this->assertStringContainsString('risque de forte houle', $notification->getContenu());
        }
    }
}
