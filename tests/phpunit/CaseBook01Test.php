<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-01-A1 — Le formulaire conduit au paiement de l'acompte. */
final class CaseBook01Test extends TestCase
{
    public function test_CASE_BOOK_01_A1_formulaire_conduit_au_paiement_acompte(): void
    {
        $sortie = (new \App\Entity\Sortie())->setPlacesRestantes(6);
        $reservation = (new \App\Entity\Reservation())
            ->setNom('Edouard')->setPrenom('Jean')
            ->setNbAdultes(4)->setNbEnfants(1)
            ->setMontantTotal(260.0)->setSortie($sortie);

        (new \App\Service\ReservationService())->reserver($reservation);

        $this->assertSame('Edouard', $reservation->getNom());
        $this->assertSame('en attente', $reservation->getEtat());
        $this->assertTrue($reservation->paiementAcompteRequis());
        $this->assertFalse($reservation->placesAcquises());
        $this->assertSame(6, $sortie->getPlacesRestantes());
    }
}
