<?php

declare(strict_types=1);

namespace App\Enum;

enum EtatSortie: string
{
    case PLANIFIEE = 'planifiee';
    case AVERTIE = 'avertie';
    case ANNULEE = 'annulee';
}
