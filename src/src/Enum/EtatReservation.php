<?php

declare(strict_types=1);

namespace App\Enum;

enum EtatReservation: string
{
    case RESERVEE = 'reservee';
    case REALISEE = 'realisee';
    case ANNULEE = 'annulee';

    public function label(): string
    {
        return match ($this) {
            self::RESERVEE => 'Réservée',
            self::REALISEE => 'Réalisée',
            self::ANNULEE => 'Annulée',
        };
    }
}
