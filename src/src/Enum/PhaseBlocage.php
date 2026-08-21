<?php

declare(strict_types=1);

namespace App\Enum;

enum PhaseBlocage: string
{
    case FORMULAIRE = 'formulaire';
    case PAIEMENT = 'paiement';
}
