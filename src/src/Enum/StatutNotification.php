<?php

declare(strict_types=1);

namespace App\Enum;

enum StatutNotification: string
{
    case EN_ATTENTE = 'en_attente';
    case ENVOYEE = 'envoyee';
    case ECHEC = 'echec';
}
