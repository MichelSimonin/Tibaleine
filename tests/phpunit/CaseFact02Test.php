<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-FACT-02 — Remise hôtel de quinze pour cent. */
final class CaseFact02Test extends TestCase
{
    public function test_CASE_FACT_02_remise_15_pourcent_hotel(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $reservation = (new \App\Entity\Reservation())
            ->setUtilisateur($hotel)->setMontantTotal(360.0)->setEtat('réservée');

        $facture = (new \App\Service\FacturationService())->facturerHotel($hotel, [$reservation]);

        $this->assertSame(360.0, $facture->getMontant());
        $this->assertSame(306.0, $facture->getMontantDu());
    }
}
