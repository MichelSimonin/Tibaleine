<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CONS-02 — L'employé voit toutes les réservations en lecture seule
 * Spécification : SPEC-CONS-01 — Critère d'acceptation : AC-02
 */
final class CaseCons02Test extends TestCase
{
    public function test_CASE_CONS_02(): void
    {
        // Étant donné un employé et 5 réservations dans le système
        $employe = new \App\Entity\Utilisateur();
        $employe->setRole('employe');
        $reservations = array_fill(0, 5, new \App\Entity\Reservation());

        // Quand il consulte les réservations
        $resultat = (new \App\Service\ConsultationService())->listerReservations($employe, $reservations);

        // Alors il voit les 5 réservations
        $this->assertCount(5, $resultat);
    }
}
