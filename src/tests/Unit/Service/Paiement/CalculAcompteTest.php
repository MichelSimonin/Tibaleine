<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\Paiement;

use App\Enum\TypeSortie;
use App\Service\Paiement\CalculAcompte;
use App\Service\Paiement\Montant;
use PHPUnit\Framework\TestCase;

final class CalculAcompteTest extends TestCase
{
    public function test_CASE_PAY_01_A1_acompte_trente_pour_cent_sortie_collective(): void
    {
        self::assertSame('39.00', (new CalculAcompte())->calculer('130.00', TypeSortie::BALEINE));
    }

    public function test_CASE_PAY_07_acompte_cinquante_pour_cent_privatisation(): void
    {
        self::assertSame('300.00', (new CalculAcompte())->calculer('600.00', TypeSortie::PRIVATISATION));
    }

    public function test_CASE_PAY_01_A1_montant_exact_sans_calcul_flottant(): void
    {
        self::assertSame(12345, Montant::enCentimes('123,45'));
        self::assertSame('123.45', Montant::depuisCentimes(12345));
    }
}
