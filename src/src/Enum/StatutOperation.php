<?php

declare(strict_types=1);

namespace App\Enum;

enum StatutOperation: string
{
    case EN_ATTENTE = 'en_attente';
    case PAYE = 'paye';
    case ECHOUE = 'echoue';
    case IMPAYE = 'impaye';
}
