<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-HOTEL-02 — L'hôtel consulte les créneaux disponibles
 * Spécification : SPEC-HOTEL-01 — Critère d'acceptation : AC-02
 */
final class CaseHotel02Test extends TestCase
{
    public function test_CASE_HOTEL_02(): void
    {
        $hotel = (new \App\Entity\Utilisateur())->setRole('hotel');
        $sortie = new \App\Entity\Sortie(); $sortie->setPlacesRestantes(6);
        $dispo = (new \App\Service\ConsultationService())->getDisponibilite($sortie);
        $this->assertSame('hotel', $hotel->getRole());
        $this->assertSame(6, $dispo->getPlacesRestantes());
    }
}
