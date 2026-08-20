<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CONS-03 — L'administrateur voit toutes les réservations avec les actions de gestion
 * Spécification : SPEC-CONS-01 — Critère d'acceptation : AC-03
 */
final class CaseCons03Test extends TestCase
{
    public function test_CASE_CONS_03(): void
    {
        // Étant donné l'administrateur et 5 réservations dans le système
        $admin = new \App\Entity\Utilisateur();
        $admin->setRole('administrateur');
        $reservations = array_fill(0, 5, new \App\Entity\Reservation());
        $service = new \App\Service\ConsultationService();

        // Quand il consulte les réservations
        $resultat = $service->listerReservations($admin, $reservations);

        // Alors il voit tout et dispose des actions de gestion
        $this->assertCount(5, $resultat);
        $this->assertTrue($service->actionsDeGestionDisponibles($admin));
    }
}
