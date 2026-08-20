<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-PAY-15 — Un non-patron ne peut pas enregistrer le solde sur place. */
final class CasePay15Test extends TestCase
{
    public function test_CASE_PAY_15_solde_sur_place_refuse_non_patron(): void
    {
        $reservation = (new \App\Entity\Reservation())
            ->setMontantTotal(260.0)
            ->setMontantEncaisse(78.0)
            ->setStatutPaiement('acompte payé');
        $employe = (new \App\Entity\Utilisateur())->setRole('employe');

        $this->expectException(\App\Exception\PaiementRefuseException::class);
        (new \App\Service\PaiementService())
            ->enregistrerSoldeSurPlace($reservation, $employe, 'SUR-PLACE-INTERDIT');
    }
}
