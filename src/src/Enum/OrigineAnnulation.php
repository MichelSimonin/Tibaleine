<?php

declare(strict_types=1);

namespace App\Enum;

enum OrigineAnnulation: string
{
    case CLIENT = 'client';
    case PRESTATAIRE = 'prestataire';
}
