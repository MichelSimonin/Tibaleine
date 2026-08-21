<?php

declare(strict_types=1);

namespace App\Enum;

enum TypePaiement: string
{
    case ACOMPTE = 'acompte';
    case SOLDE = 'solde';
    case COMPLEMENT = 'complement';
    case REMBOURSEMENT = 'remboursement';
}
