<?php
declare(strict_types=1);
namespace App\Entity;

final class Facture
{
    public function __construct(private float $montant, private float $montantDu) {}
    public function getMontant(): float { return $this->montant; }
    public function getMontantDu(): float { return $this->montantDu; }
}