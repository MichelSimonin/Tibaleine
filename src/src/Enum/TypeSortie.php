<?php

declare(strict_types=1);

namespace App\Enum;

enum TypeSortie: string
{
    case BALEINE = 'baleine';
    case DAUPHIN = 'dauphin';
    case PRIVATISATION = 'privatisation';

    public function label(): string
    {
        return match ($this) {
            self::BALEINE => 'Baleines',
            self::DAUPHIN => 'Dauphins',
            self::PRIVATISATION => 'Privatisation',
        };
    }
}
