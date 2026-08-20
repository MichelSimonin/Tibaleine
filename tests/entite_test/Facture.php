<?php

declare(strict_types=1);

namespace App\Entity;

final class Facture
{
    private string $statutPaiement = 'en attente de paiement';
    private array $paiements = [];

    public function __construct(
        private float $montant,
        private float $montantDu,
        private array $reservations = [],
    ) {
    }

    public function getMontant(): float { return $this->montant; }
    public function getMontantDu(): float { return $this->montantDu; }
    public function getReservations(): array { return $this->reservations; }
    public function getStatutPaiement(): string { return $this->statutPaiement; }
    public function setStatutPaiement(string $statut): self { $this->statutPaiement = $statut; return $this; }
    public function ajouterPaiement(Paiement $paiement): self { $this->paiements[] = $paiement; return $this; }
    public function getPaiements(): array { return $this->paiements; }
}
