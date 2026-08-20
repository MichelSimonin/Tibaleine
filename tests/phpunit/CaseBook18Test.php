<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-18 — Validation complète du formulaire de réservation. */
final class CaseBook18Test extends TestCase
{
    public function test_CASE_BOOK_18_validation_champs_obligatoires(): void
    {
        $service = new \App\Service\ValidationReservationService();
        $formulaire = [
            'nom' => 'Edouard',
            'prenom' => 'Jean',
            'email' => 'jean@example.test',
            'telephone' => '+262 692 00 00 00',
            'type' => 'baleine',
            'date' => '2026-08-22',
            'heure' => '10:00',
            'nb_adultes' => 2,
            'nb_enfants' => 0,
        ];

        $this->assertTrue($service->valider($formulaire));
        unset($formulaire['telephone']);
        $this->expectException(\InvalidArgumentException::class);
        $service->valider($formulaire);
    }
}
