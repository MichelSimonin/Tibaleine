<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-CANCEL-CLIENT-AVERTISSEMENT-03-A1 — Sortie maintenue sans réactivation. */
final class CaseCancelClientAvertissement03Test extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_03_A1_sortie_maintenue(): void
    {
        $reservation = (new \App\Entity\Reservation())->setEtat('annulée');
        (new \App\Service\AnnulationService())->sortieMaintenue($reservation);

        $this->assertSame('annulée', $reservation->getEtat());
        $this->assertFalse($reservation->placesAcquises());
    }
}
