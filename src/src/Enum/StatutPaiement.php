<?php

declare(strict_types=1);

namespace App\Enum;

enum StatutPaiement: string
{
    case EN_ATTENTE = 'en_attente_paiement';
    case ACOMPTE_PAYE = 'acompte_paye';
    case INTEGRALEMENT_PAYE = 'integralement_paye';
    case REMBOURSE = 'rembourse';

    public function label(): string
    {
        return match ($this) {
            self::EN_ATTENTE => 'En attente de paiement',
            self::ACOMPTE_PAYE => 'Acompte payé',
            self::INTEGRALEMENT_PAYE => 'Intégralement payé',
            self::REMBOURSE => 'Remboursé',
        };
    }
}
