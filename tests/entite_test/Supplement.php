<?php
declare(strict_types=1);
namespace App\Entity;

final class Supplement
{
    public function isDu(): bool { return true; }
    public function getLienPaiementEnvoye(): bool { return true; }
}