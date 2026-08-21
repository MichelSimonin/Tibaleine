<?php

declare(strict_types=1);

namespace App\Enum;

enum CanalPaiement: string
{
    case EN_LIGNE = 'en_ligne';
    case SUR_PLACE = 'sur_place';
}
