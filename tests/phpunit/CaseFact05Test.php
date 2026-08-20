<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-FACT-05 — Règlement hôtel enregistré une seule fois. */
final class CaseFact05Test extends TestCase
{
    public function test_CASE_FACT_05_reglement_hotel_unique(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $reservation = (new \App\Entity\Reservation())
            ->setUtilisateur($hotel)->setMontantTotal(360.0)->setEtat('réservée');
        $service = new \App\Service\FacturationService();
        $facture = $service->facturerHotel($hotel, [$reservation]);

        $premier = $service->enregistrerReglement($facture, 'REF-FACT-05');
        $second = $service->enregistrerReglement($facture, 'REF-FACT-05');

        $this->assertSame($premier, $second);
        $this->assertSame(1, $service->nombreReglements());
        $this->assertCount(1, $facture->getPaiements());
        $this->assertSame('intégralement payé', $reservation->getStatutPaiement());
    }
}
