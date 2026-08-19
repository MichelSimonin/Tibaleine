<?php

declare(strict_types=1);

namespace App\Entity;

final class Reservation
{
    private ?string $nom = null;
    private ?string $prenom = null;
    private int $nbAdultes = 0;
    private int $nbEnfants = 0;
    private string $etat = 'en attente';
    private float $montantTotal = 0.0;
    private ?Sortie $sortie = null;
    private ?Utilisateur $utilisateur = null;
    private ?string $profil = null;
    private ?string $langueClient = null;
    private bool $avertissementRecu = false;

    public function setNom(string $nom): self { $this->nom = $nom; return $this; }
    public function getNom(): ?string { return $this->nom; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }
    public function getPrenom(): ?string { return $this->prenom; }
    public function setNbAdultes(int $nombre): self { $this->nbAdultes = $nombre; return $this; }
    public function getNbAdultes(): int { return $this->nbAdultes; }
    public function setNbEnfants(int $nombre): self { $this->nbEnfants = $nombre; return $this; }
    public function getNbEnfants(): int { return $this->nbEnfants; }
    public function setEtat(string $etat): self { $this->etat = $etat; return $this; }
    public function getEtat(): string { return $this->etat; }
    public function setMontantTotal(float $montant): self { $this->montantTotal = $montant; return $this; }
    public function getMontantTotal(): float { return $this->montantTotal; }
    public function setSortie(Sortie $sortie): self { $this->sortie = $sortie; return $this; }
    public function getSortie(): ?Sortie { return $this->sortie; }
    public function setUtilisateur(Utilisateur $utilisateur): self { $this->utilisateur = $utilisateur; return $this; }
    public function getUtilisateur(): ?Utilisateur { return $this->utilisateur; }
    public function setProfil(string $profil): self { $this->profil = $profil; return $this; }
    public function getProfil(): ?string { return $this->profil; }
    public function setLangueClient(string $langue): self { $this->langueClient = $langue; return $this; }
    public function getLangueClient(): ?string { return $this->langueClient; }
    public function setAvertissementRecu(bool $recu): self { $this->avertissementRecu = $recu; return $this; }
    public function getAvertissementRecu(): bool { return $this->avertissementRecu; }
}