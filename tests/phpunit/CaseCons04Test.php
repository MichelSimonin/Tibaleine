<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * CASE-CONS-04 — Un client ne peut pas accéder à la réservation d'un autre client
 * Spécification : SPEC-CONS-01 — Critère d'acceptation : ?
 */
final class CaseCons04Test extends TestCase
{
    public function test_CASE_CONS_04(): void
    {
        // Étant donné un client et la réservation d'un autre client
        $client = new \App\Entity\Utilisateur();
        $client->setRole('utilisateur');
        $autre = new \App\Entity\Reservation();
        $autre->setUtilisateur(new \App\Entity\Utilisateur());

        // Quand il tente d'y accéder directement
        $this->expectException(\App\Exception\AccesRefuseException::class);
        (new \App\Service\ConsultationService())->accederReservation($client, $autre);
    }
}
