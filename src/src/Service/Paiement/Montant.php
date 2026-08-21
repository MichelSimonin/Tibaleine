<?php

declare(strict_types=1);

namespace App\Service\Paiement;

final class Montant
{
    public static function enCentimes(string $montant): int
    {
        $normalise = str_replace(',', '.', trim($montant));
        [$euros, $centimes] = array_pad(explode('.', $normalise, 2), 2, '0');
        return ((int) $euros * 100) + (int) str_pad(substr($centimes, 0, 2), 2, '0');
    }

    public static function depuisCentimes(int $centimes): string
    {
        return number_format($centimes / 100, 2, '.', '');
    }
}
