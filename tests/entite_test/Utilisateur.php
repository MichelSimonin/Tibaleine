<?php

declare(strict_types=1);

namespace App\Entity;

final class Utilisateur
{
    private ?string $role = null;
    private ?string $profil = null;
    private ?string $email = null;

    public function setRole(string $role): self { $this->role = $role; return $this; }
    public function getRole(): ?string { return $this->role; }
    public function setProfil(string $profil): self { $this->profil = $profil; return $this; }
    public function getProfil(): ?string { return $this->profil; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function getEmail(): ?string { return $this->email; }
}