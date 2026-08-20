<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;

/** CASE-BOOK-07-A1 — Tentative commencée avant expiration. */
final class CaseBook07Test extends TestCase
{
    public function test_CASE_BOOK_07_A1_tentative_commencee_avant_expiration(): void
    {
        $reservation = (new \App\Entity\Reservation())->setMontantTotal(260.0);
        $service = new \App\Service\PaiementService();
        $service->commencerTentativeAcompte(
            $reservation,
            'TENTATIVE-07',
            new \DateTimeImmutable('2026-08-22 17:59'),
            new \DateTimeImmutable('2026-08-22 18:00'),
        );

        $premiere = $service->confirmerTentativeAcompte('TENTATIVE-07', 78.0);
        $seconde = $service->confirmerTentativeAcompte('TENTATIVE-07', 78.0);

        $this->assertSame($premiere, $seconde);
        $this->assertSame(1, $service->nombreOperations());
        $this->assertSame('réservée', $reservation->getEtat());

        $expiree = (new \App\Entity\Reservation())->setEtat('expirée');
        $this->expectException(\App\Exception\PaiementRefuseException::class);
        $service->commencerTentativeAcompte(
            $expiree,
            'NOUVELLE-07',
            new \DateTimeImmutable('2026-08-22 18:01'),
            new \DateTimeImmutable('2026-08-22 18:15'),
        );
    }
}
