<?php

declare(strict_types=1);

namespace App\Entity;

final class Paiement
{
    public function __construct(
        private float $montant,
        private string $reference = '',
        private string $type = 'acompte',
    ) {
    }

    public function getMontant(): float { return $this->montant; }
    public function getReference(): string { return $this->reference; }
    public function getType(): string { return $this->type; }
}
