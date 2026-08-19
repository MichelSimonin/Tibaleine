<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CONS-05 — Une tentative de modification par l'employé est bloquée
 * Spécification : SPEC-CONS-01 — Critère d'acceptation : ?
 */
final class CaseCons05Test extends TestCase
{
    public function test_CASE_CONS_05(): void
    {
        // Étant donné un employé
        $employe = new \App\Entity\Utilisateur();
        $employe->setRole('employe');

        // Quand il tente de modifier une réservation
        $this->expectException(\App\Exception\AccesRefuseException::class);
        (new \App\Service\ConsultationService())->modifierReservation($employe, new \App\Entity\Reservation());
    }
}
