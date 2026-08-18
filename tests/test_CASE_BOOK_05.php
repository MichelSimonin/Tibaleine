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
    public function test_CASE_BOOK_05(): void
    {
        // Quand l'hôtel tente de réserver plus de 6 places
        $this->expectException(\App\Exception\LimitePlacesDepasseeException::class);
        (new \App\Service\ReservationService())->reserverPourHotel([['sortie' => '19.08', 'nb' => 36]]);
    }
}
