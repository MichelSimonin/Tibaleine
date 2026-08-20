<?php
declare(strict_types=1);
namespace App\Entity;

final class Remboursement
{
    public function __construct(private float $montant) {}
    public function getMontant(): float { return $this->montant; }
}