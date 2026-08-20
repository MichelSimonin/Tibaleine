<?php

declare(strict_types=1);

namespace App\Entity;

final class ResultatAnnulation
{
    public function __construct(
        private float $frais,
        private float $complementDu,
        private float $tropPercu,
        private ?string $lienPaiement = null,
    ) {
    }

    public function getFrais(): float { return $this->frais; }
    public function getComplementDu(): float { return $this->complementDu; }
    public function getTropPercu(): float { return $this->tropPercu; }
    public function getLienPaiement(): ?string { return $this->lienPaiement; }
}
