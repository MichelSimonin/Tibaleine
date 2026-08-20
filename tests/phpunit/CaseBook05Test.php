<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-05— L'hôtel ne peut pas réserver plus de 6 places sur un même créneau. 
 * Spécification : SPEC-BOOK-02 — Critère d'acceptation : AC-03
 */
final class CaseBook05Test extends TestCase
{
    public function test_CASE_BOOK_05_hotel_limite_6(): void
    {
        // Quand l'hôtel tente de réserver plus de 6 places
        $resultat = (new \App\Service\ReservationService())->reserverPourHotel([['sortie' => '19.08', 'nb' => 7]]);
        $this->assertCount(0, $resultat['reussies']);
        $this->assertCount(1, $resultat['echouees']);
    }
}
