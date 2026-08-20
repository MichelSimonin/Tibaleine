<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-JUSTIF-01 — Justificatif après paiement de l’acompte
 * Spécification : SPEC-JUSTIF-01 — Critères d'acceptation : AC-1, AC-3, AC-4
 */
final class CaseJustif01Test extends TestCase
{
    public function test_CASE_JUSTIF_01_justificatif_apres_acompte(): void
    {
        $reservation = new \App\Entity\Reservation();
        $reservation->setMontantTotal(120.0);

        $document = (new \App\Service\DocumentService())->genererJustificatifAcompte($reservation);

        $this->assertSame('justificatif_acompte', $document->getType());
        $this->assertSame(120.0, $document->getMontant());
        $this->assertNotSame('', $document->getReference());
    }
}
