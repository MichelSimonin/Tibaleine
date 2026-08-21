<?php

declare(strict_types=1);

namespace App\Enum;

enum TypeNotification: string
{
    case AVERTISSEMENT = 'avertissement';
    case ANNULATION = 'annulation';
    case CONFIRMATION = 'confirmation_demande';
    case CRENEAU_INDISPONIBLE = 'creneau_indisponible';
    case LIEN_SOLDE = 'lien_solde';
}
