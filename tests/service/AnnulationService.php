<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Reservation;
use App\Entity\Remboursement;
use App\Entity\ResultatAnnulation;
use App\Entity\Sortie;

final class AnnulationService
{
    private array $remboursements = [];

    public function annulerClient(Reservation $reservation, \DateTimeImmutable $maintenant): Remboursement
    {
        $date = $reservation->getSortie()?->getDate();
        $heures = $date === null ? 0 : ($date->getTimestamp() - $maintenant->getTimestamp()) / 3600;
        $tauxRembourse = $heures < 48 ? 0.5 : ($heures <= 168 ? 0.75 : 1.0);
        $reservation->setEtat('annulée');
        return new Remboursement($reservation->getMontantTotal() * $tauxRembourse);
    }

    public function calculerAnnulationClient(Reservation $reservation, \DateTimeImmutable $maintenant): ResultatAnnulation
    {
        $date = $reservation->getSortie()?->getDate();
        if ($date === null || $maintenant >= $date || in_array($reservation->getEtat(), ['annulée', 'réalisée'], true)) {
            throw new \LogicException('Cette réservation ne peut plus être annulée.');
        }
        $heures = ($date->getTimestamp() - $maintenant->getTimestamp()) / 3600;
        $tauxFrais = $heures < 48 ? 0.5 : ($heures <= 168 ? 0.25 : 0.0);
        $frais = $reservation->getMontantInitial() * $tauxFrais;
        $complement = max(0.0, $frais - $reservation->getMontantEncaisse());
        $tropPercu = max(0.0, $reservation->getMontantEncaisse() - $frais);
        $reservation->setEtat('annulée');
        return new ResultatAnnulation($frais, $complement, $tropPercu, $complement > 0 ? 'ANNULATION-24H' : null);
    }

    public function calculerApresAvertissement(Reservation $reservation): float
    {
        if (!$reservation->getAvertissementRecu()) {
            throw new \LogicException('Aucun avertissement envoyé avec succès.');
        }
        $reservation->setEtat('annulée');
        return $reservation->getMontantEncaisse();
    }

    public function confirmerRemboursement(Reservation $reservation, float $montant, string $reference): Remboursement
    {
        if (isset($this->remboursements[$reference])) {
            return $this->remboursements[$reference];
        }
        $remboursement = new Remboursement($montant, $reference);
        $reservation->ajouterRemboursement($remboursement);
        $this->remboursements[$reference] = $remboursement;
        return $remboursement;
    }

    public function annulerApresAvertissement(Reservation $reservation): Remboursement
    {
        $reservation->setEtat('annulée');
        return new Remboursement($reservation->getMontantTotal());
    }

    public function sortieMaintenue(Reservation $reservation): void
    {
        // Une décision ultérieure de maintien ne réactive jamais une réservation annulée.
    }

    public function enregistrerAbsence(Reservation $reservation): ?Remboursement
    {
        $reservation->setEtat('réalisée');
        return null;
    }

    public function choisirApresAnnulationPrestataire(Reservation $reservation, string $choix): void
    {
        if (!in_array($choix, ['remboursement', 'report'], true)) {
            throw new \LogicException('Choix invalide.');
        }
        if ($reservation->getChoixApresAnnulation() !== null && $reservation->getChoixApresAnnulation() !== $choix) {
            throw new \LogicException('Le remboursement et le report sont exclusifs.');
        }
        $reservation->setChoixApresAnnulation($choix);
    }

    public function reporter(Reservation $reservation, Sortie $nouvelleSortie): void
    {
        if ($reservation->getChoixApresAnnulation() !== 'report') {
            throw new \LogicException('Le report doit être choisi explicitement.');
        }
        $reservation->setSortie($nouvelleSortie)->setEtat('réservée');
        $nouvelleSortie->addReservation($reservation);
    }

    public function nombreRemboursements(): int { return count($this->remboursements); }
}
