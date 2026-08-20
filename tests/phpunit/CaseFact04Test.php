<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-FACT-04 — Aucune facture mensuelle pour un client ordinaire. */
final class CaseFact04Test extends TestCase
{
    public function test_CASE_FACT_04_aucune_facture_mensuelle_client(): void
    {
        $client = (new \App\Entity\Utilisateur())->setRole('utilisateur');
        $reservations = [(new \App\Entity\Reservation())->setUtilisateur($client)->setMontantTotal(260.0)];

        $facture = (new \App\Service\FacturationService())->facturerMensuellement($client, $reservations);

        $this->assertNull($facture);
    }
}
