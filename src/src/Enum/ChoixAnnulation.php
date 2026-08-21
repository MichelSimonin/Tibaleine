<?php

declare(strict_types=1);

namespace App\Enum;

enum ChoixAnnulation: string
{
    case REMBOURSEMENT = 'remboursement';
    case REPORT = 'report';
}
