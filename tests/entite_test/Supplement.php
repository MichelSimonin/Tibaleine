<?php
declare(strict_types=1);
namespace App\Entity;

final class Supplement
{
    public function __construct(private bool $du = true, private bool $lienPaiementEnvoye = false) {}
    public function isDu(): bool { return $this->du; }
    public function getLienPaiementEnvoye(): bool { return $this->lienPaiementEnvoye; }
}
