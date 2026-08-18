<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-MODIF-03 — Un ajout de participant entraîne un supplément payé par mail
 * Spécification : SPEC-MODIF-01 — Critère d'acceptation : AC-03
 */
final class CaseModif03Test extends TestCase
{
    public function test_CASE_MODIF_03(): void
    {
        $reservation = new \App\Entity\Reservation();
        $reservation->setEtat('payée');

        $supplement = (new \App\Service\ReservationService())->ajouterParticipant($reservation, 1);

        $this->assertTrue($supplement->isDu());
        $this->assertTrue($supplement->getLienPaiementEnvoye());
    }
}
