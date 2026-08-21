<?php

declare(strict_types=1);

namespace App\Enum;

enum TypeDocument: string
{
    case JUSTIFICATIF_ACOMPTE = 'justificatif_acompte';
    case FACTURE_FINALE = 'facture_finale';
    case FACTURE_HOTEL_MENSUELLE = 'facture_hotel_mensuelle';
}
