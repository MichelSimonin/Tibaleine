<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-04-A1 — Places acquises après confirmation de l'acompte. */
final class CaseBook04Test extends TestCase
{
    public function test_CASE_BOOK_04_A1_places_acquises_apres_acompte(): void
    {
        $sortie = (new \App\Entity\Sortie())->setPlacesRestantes(6);
        $reservation = (new \App\Entity\Reservation())
            ->setSortie($sortie)->setNbAdultes(4)->setNbEnfants(1)->setMontantTotal(300.0);

        (new \App\Service\PaiementService())->confirmerAcompte($reservation, 90.0, 'ACOMPTE-BOOK-04');

        $this->assertSame('réservée', $reservation->getEtat());
        $this->assertSame('acompte payé', $reservation->getStatutPaiement());
        $this->assertTrue($reservation->placesAcquises());
        $this->assertSame(1, $sortie->getPlacesRestantes());
    }
}
