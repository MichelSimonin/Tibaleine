<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Reservation;
use App\Entity\Remboursement;

final class AnnulationService
{
    public function annulerClient(Reservation $reservation, \DateTimeImmutable $maintenant): Remboursement { $date = $reservation->getSortie()?->getDate(); $heures = $date === null ? 0 : ($date->getTimestamp() - $maintenant->getTimestamp()) / 3600; $taux = $heures < 48 ? 0.5 : ($heures <= 168 ? 0.75 : 1.0); return $this->annuler($reservation, $reservation->getMontantTotal() * $taux); }
    public function annulerApresAvertissement(Reservation $reservation): Remboursement { return $this->annuler($reservation, $reservation->getMontantTotal()); }
    public function sortieMaintenue(Reservation $reservation): void { }
    private function annuler(Reservation $reservation, float $montant): Remboursement { $reservation->setEtat('annulée'); return new Remboursement($montant); }
}