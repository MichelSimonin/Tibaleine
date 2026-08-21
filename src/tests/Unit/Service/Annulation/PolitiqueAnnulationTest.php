<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\Annulation;

use App\Entity\Bateau;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Enum\CanalPaiement;
use App\Enum\EtatSortie;
use App\Enum\TypePaiement;
use App\Enum\TypeSortie;
use App\Service\Annulation\PolitiqueAnnulation;
use PHPUnit\Framework\TestCase;

final class PolitiqueAnnulationTest extends TestCase
{
    public function test_CASE_CANCEL_CLIENT_02_A1_bornes_du_bareme_exactes(): void
    {
        self::assertSame(['frais' => '0.00', 'remboursement' => '30.00', 'complement' => '0.00'], $this->calculerPour('+7 days +1 minute'));
        self::assertSame(['frais' => '25.00', 'remboursement' => '5.00', 'complement' => '0.00'], $this->calculerPour('+7 days'));
        self::assertSame(['frais' => '25.00', 'remboursement' => '5.00', 'complement' => '0.00'], $this->calculerPour('+48 hours'));
        self::assertSame(['frais' => '50.00', 'remboursement' => '0.00', 'complement' => '20.00'], $this->calculerPour('+47 hours +59 minutes'));
    }

    public function test_CASE_CANCEL_CLIENT_AVERTISSEMENT_01_A1_remboursement_integral_apres_avertissement(): void
    {
        self::assertSame(['frais' => '0.00', 'remboursement' => '30.00', 'complement' => '0.00'], $this->calculerPour('+6 hours', true));
    }

    /** @return array{frais: string, remboursement: string, complement: string} */
    private function calculerPour(string $ecart, bool $avertie = false): array
    {
        $timezone = new \DateTimeZone('Indian/Reunion');
        $maintenant = new \DateTimeImmutable('2026-08-21 10:00:00', $timezone);
        $depart = $maintenant->modify($ecart);
        $sortie = (new Sortie())->setType(TypeSortie::BALEINE)->setBateau(new Bateau('Test', 12))
            ->setDate($depart->setTime(0, 0))->setHeureDepart(new \DateTimeImmutable($depart->format('H:i:s'), $timezone));
        if ($avertie) { $sortie->setEtat(EtatSortie::AVERTIE); }
        $reservation = (new Reservation())->setSortie($sortie)->setMontantInitial('100.00');
        $reservation->addPaiement((new Paiement())->setType(TypePaiement::ACOMPTE)->setCanal(CanalPaiement::EN_LIGNE)->setMontant('30.00')->confirmer());

        return (new PolitiqueAnnulation())->calculer($reservation, $maintenant);
    }
}
