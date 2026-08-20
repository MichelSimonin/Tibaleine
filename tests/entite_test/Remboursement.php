<?php

declare(strict_types=1);

namespace App\Entity;

final class Remboursement
{
    public function __construct(private float $montant, private string $reference = '') {}
    public function getMontant(): float { return $this->montant; }
    public function getReference(): string { return $this->reference; }
}
