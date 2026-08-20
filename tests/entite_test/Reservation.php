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
    private string $statutPaiement = 'en attente de paiement';
    private float $montantInitial = 0.0;
    private float $montantCourant = 0.0;
    private float $montantEncaisse = 0.0;
    private ?string $modePaiementPrevu = null;
    private ?Sortie $sortie = null;
    private ?Utilisateur $utilisateur = null;
    private ?string $profil = null;
    private ?string $langueClient = null;
    private bool $avertissementRecu = false;
    private bool $placesAcquises = false;
    private bool $paiementAcompteRequis = false;
    private ?string $choixApresAnnulation = null;
    private array $paiements = [];
    private array $remboursements = [];

    public function setNom(string $nom): self { $this->nom = $nom; return $this; }
    public function getNom(): ?string { return $this->nom; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }
    public function getPrenom(): ?string { return $this->prenom; }
    public function setNbAdultes(int $nombre): self { $this->nbAdultes = $nombre; return $this; }
    public function getNbAdultes(): int { return $this->nbAdultes; }
    public function setNbEnfants(int $nombre): self { $this->nbEnfants = $nombre; return $this; }
    public function getNbEnfants(): int { return $this->nbEnfants; }
    public function getNombrePlaces(): int { return $this->nbAdultes + $this->nbEnfants; }
    public function setEtat(string $etat): self { $this->etat = $etat; return $this; }
    public function getEtat(): string { return $this->etat; }
    public function setStatutPaiement(string $statut): self { $this->statutPaiement = $statut; return $this; }
    public function getStatutPaiement(): string { return $this->statutPaiement; }

    public function setMontantTotal(float $montant): self
    {
        $this->montantInitial = $montant;
        $this->montantCourant = $montant;
        return $this;
    }

    public function getMontantTotal(): float { return $this->montantCourant; }
    public function setMontantInitial(float $montant): self { $this->montantInitial = $montant; return $this; }
    public function getMontantInitial(): float { return $this->montantInitial; }
    public function setMontantCourant(float $montant): self { $this->montantCourant = $montant; return $this; }
    public function getMontantCourant(): float { return $this->montantCourant; }
    public function setMontantEncaisse(float $montant): self { $this->montantEncaisse = $montant; return $this; }
    public function getMontantEncaisse(): float { return $this->montantEncaisse; }
    public function getSoldeRestant(): float { return max(0.0, $this->montantCourant - $this->montantEncaisse); }
    public function getTropPercu(): float { return max(0.0, $this->montantEncaisse - $this->montantCourant); }
    public function setModePaiementPrevu(?string $mode): self { $this->modePaiementPrevu = $mode; return $this; }
    public function getModePaiementPrevu(): ?string { return $this->modePaiementPrevu; }

    public function setSortie(Sortie $sortie): self { $this->sortie = $sortie; return $this; }
    public function getSortie(): ?Sortie { return $this->sortie; }
    public function setUtilisateur(Utilisateur $utilisateur): self { $this->utilisateur = $utilisateur; return $this; }
    public function getUtilisateur(): ?Utilisateur { return $this->utilisateur; }
    public function setProfil(string $profil): self { $this->profil = $profil; return $this; }
    public function getProfil(): ?string { return $this->profil; }
    public function estReservationHotel(): bool { return $this->utilisateur?->getRole() === 'hotel' || $this->profil === 'hotel'; }
    public function setLangueClient(string $langue): self { $this->langueClient = $langue; return $this; }
    public function getLangueClient(): ?string { return $this->langueClient; }
    public function setAvertissementRecu(bool $recu): self { $this->avertissementRecu = $recu; return $this; }
    public function getAvertissementRecu(): bool { return $this->avertissementRecu; }
    public function setPlacesAcquises(bool $acquises): self { $this->placesAcquises = $acquises; return $this; }
    public function placesAcquises(): bool { return $this->placesAcquises; }
    public function setPaiementAcompteRequis(bool $requis): self { $this->paiementAcompteRequis = $requis; return $this; }
    public function paiementAcompteRequis(): bool { return $this->paiementAcompteRequis; }
    public function setChoixApresAnnulation(string $choix): self { $this->choixApresAnnulation = $choix; return $this; }
    public function getChoixApresAnnulation(): ?string { return $this->choixApresAnnulation; }

    public function ajouterPaiement(Paiement $paiement): self
    {
        $this->paiements[] = $paiement;
        $this->montantEncaisse += $paiement->getMontant();
        return $this;
    }

    public function getPaiements(): array { return $this->paiements; }
    public function ajouterRemboursement(Remboursement $remboursement): self { $this->remboursements[] = $remboursement; return $this; }
    public function getRemboursements(): array { return $this->remboursements; }
}
