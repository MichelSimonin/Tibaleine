<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Facture;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Utilisateur;

final class FacturationService
{
    private array $reglements = [];

    public function facturerHotel(Utilisateur $hotel, array $reservations, ?\DateTimeImmutable $mois = null): Facture
    {
        if ($hotel->getRole() !== 'hotel') {
            throw new \LogicException('La facturation mensuelle est réservée aux hôtels.');
        }
        $facturables = array_values(array_filter(
            $reservations,
            static function (Reservation $reservation) use ($hotel, $mois): bool {
                if ($reservation->getEtat() === 'annulée' || $reservation->getUtilisateur() !== $hotel) {
                    return false;
                }
                if ($mois === null) {
                    return true;
                }
                $dateSortie = $reservation->getSortie()?->getDate();
                return $dateSortie !== null && $dateSortie->format('Y-m') === $mois->format('Y-m');
            },
        ));
        $montant = array_sum(array_map(static fn (Reservation $reservation): float => $reservation->getMontantTotal(), $facturables));
        return new Facture($montant, $montant * 0.85, $facturables);
    }

    public function facturerMensuellement(Utilisateur $utilisateur, array $reservations): ?Facture
    {
        return $utilisateur->getRole() === 'hotel' ? $this->facturerHotel($utilisateur, $reservations) : null;
    }

    public function enregistrerReglement(Facture $facture, string $reference): Paiement
    {
        if (isset($this->reglements[$reference])) {
            return $this->reglements[$reference];
        }
        $paiement = new Paiement($facture->getMontantDu(), $reference, 'facture_hotel');
        $facture->ajouterPaiement($paiement)->setStatutPaiement('intégralement payé');
        foreach ($facture->getReservations() as $reservation) {
            $reservation->setStatutPaiement('intégralement payé');
        }
        $this->reglements[$reference] = $paiement;
        return $paiement;
    }

    public function nombreReglements(): int { return count($this->reglements); }
}
