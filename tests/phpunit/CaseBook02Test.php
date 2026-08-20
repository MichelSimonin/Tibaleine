<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-BOOK-02 — L'hôtel réserve plusieurs créneaux (6 places max, échec si places insuffisantes)
 * Spécification : SPEC-BOOK-02 — Critère d'acceptation : AC-01
 */
final class CaseBook02Test extends TestCase
{
    public function test_CASE_BOOK_02(): void
    {
        // Quand l'hôtel réserve sur 3 créneaux (6, 4 et 4 places)
        $resultat = (new \App\Service\ReservationService())->reserverPourHotel([
            ['sortie' => '17.08', 'nb' => 6],
            ['sortie' => '20.08', 'nb' => 4],
            ['sortie' => '21.08', 'nb' => 4],
        ]);

        // Alors 2 réservations réussissent et 1 échoue (places insuffisantes)
        $this->assertCount(2, $resultat['reussies']);
        $this->assertCount(1, $resultat['echouees']);
    }
}
