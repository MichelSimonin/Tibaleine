<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-PRESTATAIRE-01 — Le prestataire envoie un avertissement à 18h la veille en cas de risque météo
 * Spécification : SPEC-CANCEL-PRESTATAIRE-02 — Critère d'acceptation : AC-01
 */
final class CaseCancelPrestataire01Test extends TestCase
{
    public function test_CASE_CANCEL_PRESTATAIRE_01(): void
    {
        // Étant donné une sortie avec 5 réservations payées
        $sortie = new \App\Entity\Sortie();
        for ($i = 0; $i < 5; $i++) {
            $r = new \App\Entity\Reservation();
            $r->setEtat('payée');
            $sortie->addReservation($r);
        }

        // Quand le prestataire déclenche l'avertissement à 18h la veille
        $notifications = (new \App\Service\NotificationService())
            ->envoyerAvertissement($sortie, new \DateTimeImmutable('2026-07-11 18:00'));

        // Alors les 5 clients sont notifiés
        $this->assertCount(5, $notifications);
        $this->assertSame('avertissement', $notifications[0]->getType());
    }
}
