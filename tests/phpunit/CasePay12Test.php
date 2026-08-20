<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-12 — Solde sur place enregistré par le patron. */
final class CasePay12Test extends TestCase
{
    public function test_CASE_PAY_12_solde_sur_place_patron(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setMontantTotal(260.0)->setMontantEncaisse(78.0)
            ->setEtat('réservée')->setStatutPaiement('acompte payé');
        $patron = (new \App\Entity\Utilisateur())->setRole('patron');
        $service = new \App\Service\PaiementService();

        $paiement = $service->enregistrerSoldeSurPlace($reservation, $patron, 'SUR-PLACE-12');
        $this->assertSame(182.0, $paiement->getMontant());
        $this->assertSame('intégralement payé', $reservation->getStatutPaiement());
        $this->assertSame('réservée', $reservation->getEtat());

        $sortie = (new \App\Entity\Sortie())->setDate(new \DateTimeImmutable('2026-08-22 10:00'));
        $avecTentative = (new \App\Entity\Reservation())
            ->setSortie($sortie)->setMontantTotal(260.0)->setMontantEncaisse(78.0);
        $service->commencerPaiementSolde($avecTentative, 'ONLINE-12', new \DateTimeImmutable('2026-08-21 21:00'));
        $this->expectException(\App\Exception\PaiementRefuseException::class);
        $service->enregistrerSoldeSurPlace($avecTentative, $patron, 'SUR-PLACE-REFUSE-12');
    }
}
