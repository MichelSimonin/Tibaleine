<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-FACT-06 — Une facture hôtel ne regroupe qu'un seul mois. */
final class CaseFact06Test extends TestCase
{
    public function test_CASE_FACT_06_facture_un_seul_hotel_un_seul_mois(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $autreHotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $aout = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-22 10:00'));
        $septembre = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-09-02 10:00'));
        $rAout = (new \App\Entity\Reservation())->setUtilisateur($hotel)->setSortie($aout)->setMontantTotal(100.0)->setEtat('réservée');
        $rSeptembre = (new \App\Entity\Reservation())->setUtilisateur($hotel)->setSortie($septembre)->setMontantTotal(200.0)->setEtat('réservée');
        $rAutreHotel = (new \App\Entity\Reservation())->setUtilisateur($autreHotel)->setSortie($aout)->setMontantTotal(300.0)->setEtat('réservée');

        $facture = (new \App\Service\FacturationService())
            ->facturerHotel($hotel, [$rAout, $rSeptembre, $rAutreHotel], new \DateTimeImmutable('2026-08-01'));

        $this->assertSame(100.0, $facture->getMontant());
        $this->assertCount(1, $facture->getReservations());
        $this->assertSame($rAout, $facture->getReservations()[0]);
    }
}
