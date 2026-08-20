<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-JUSTIF-02 — Facture finale après paiement intégral
 * Spécification : SPEC-JUSTIF-01 — Critères d'acceptation : AC-2, AC-3, AC-4
 */
final class CaseJustif02Test extends TestCase
{
    public function test_CASE_JUSTIF_02_facture_finale_tous_canaux(): void
    {
        foreach (['en_ligne', 'sur_place'] as $canal) {
            $reservation = new \App\Entity\Reservation();
            $reservation->setMontantTotal(260.0);

            $document = (new \App\Service\DocumentService())->genererFactureFinale($reservation, $canal);

            $this->assertSame('facture_finale', $document->getType());
            $this->assertSame(260.0, $document->getMontant());
            $this->assertStringContainsString($canal, $document->getReference());
        }
    }
}
