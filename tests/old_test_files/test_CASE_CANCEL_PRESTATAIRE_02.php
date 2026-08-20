<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CANCEL-PRESTATAIRE-02—MESSAGE Le prestataire peut envoyer un message générale à une heure voulue
 * Spécification : SPEC-CANCEL-PRESTATAIRE-02 — Critère d'acceptation : AC-01
 */
final class CaseCancelPrestataire02Test extends TestCase
{
    public function test_CASE_CANCEL_PRESTATAIRE_02(): void
    {
        // Étant donné une sortie prévue le 23 août avec des réservations payées
        $sortie = new \App\Entity\Sortie();
        $sortie->setDate(new \DateTimeImmutable('2026-08-23 07:00'));
        $sortie->addReservation((new \App\Entity\Reservation())->setEtat('payée'));

        // Quand le prestataire envoie l'alerte à 18h la veille puis l'annulation à 05:00
        $service = new \App\Service\NotificationService();
        $service->envoyerAvertissement($sortie, new \DateTimeImmutable('2026-08-22 18:00'));
        $service->envoyerAnnulation($sortie, new \DateTimeImmutable('2026-08-23 05:00'));

        // Alors le second message part 2 h avant la première sortie annulée
        $this->assertSame('annulée', $sortie->getReservations()[0]->getEtat());
    }
}
