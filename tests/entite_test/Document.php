<?php

declare(strict_types=1);

namespace App\Entity;

final class Document
{
    public function __construct(
        private string $type,
        private string $reference,
        private float $montant = 0.0,
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }
}
