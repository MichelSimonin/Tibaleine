<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-03-A1 — Confirmation répétée sans nouveau décompte. */
final class CasePay03Test extends TestCase
{
    public function test_CASE_PAY_03_A1_confirmation_repetee_sans_redecompte(): void
    {
        $sortie = (new \App\Entity\Sortie())->setPlacesRestantes(4);
        $reservation = (new \App\Entity\Reservation())
            ->setSortie($sortie)->setNbAdultes(2)->setMontantTotal(260.0);
        $service = new \App\Service\PaiementService();

        $premier = $service->confirmerAcompte($reservation, 78.0, 'REF-PAY-03');
        $second = $service->confirmerAcompte($reservation, 78.0, 'REF-PAY-03');

        $this->assertSame($premier, $second);
        $this->assertSame(2, $sortie->getPlacesRestantes());
        $this->assertCount(1, $reservation->getPaiements());
        $this->assertSame(1, $service->nombreOperations());
    }
}
