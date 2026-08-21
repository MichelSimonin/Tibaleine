<?php

declare(strict_types=1);

namespace App\Service\Paiement;

use App\Enum\TypeSortie;

final class CalculAcompte
{
    public function calculer(string $montantInitial, TypeSortie $type): string
    {
        $pourcentage = $type === TypeSortie::PRIVATISATION ? 50 : 30;
        $centimes = Montant::enCentimes($montantInitial);
        return Montant::depuisCentimes((int) round($centimes * $pourcentage / 100, 0, PHP_ROUND_HALF_UP));
    }
}
