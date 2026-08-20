<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Exception\PaiementRefuseException;

final class PaiementService
{
    private array $operations = [];
    private array $tentativesAcompte = [];
    private array $tentativesSolde = [];

    public function calculerAcompte(float $montantTtc, bool $privatisation = false): float
    {
        return $montantTtc * ($privatisation ? 0.5 : 0.3);
    }

    public function payer(Reservation $reservation): Paiement
    {
        if ($reservation->getMontantTotal() <= 0.0) {
            throw new PaiementRefuseException('Montant invalide.');
        }
        $reference = 'FULL-' . spl_object_id($reservation);
        $paiement = new Paiement($reservation->getMontantTotal(), $reference, 'integral');
        $reservation->ajouterPaiement($paiement)->setEtat('réservée')->setStatutPaiement('intégralement payé');
        $this->acquerirPlaces($reservation);
        $this->operations[$reference] = $paiement;
        return $paiement;
    }

    public function confirmerAcompte(Reservation $reservation, float $montant, string $reference, bool $confirmationValide = true): ?Paiement
    {
        if (isset($this->operations[$reference])) {
            return $this->operations[$reference];
        }
        if (!$confirmationValide || $montant <= 0.0) {
            return null;
        }

        $paiement = new Paiement($montant, $reference, 'acompte');
        $reservation
            ->ajouterPaiement($paiement)
            ->setEtat('réservée')
            ->setStatutPaiement('acompte payé');
        $this->acquerirPlaces($reservation);
        $this->operations[$reference] = $paiement;
        return $paiement;
    }

    private function acquerirPlaces(Reservation $reservation): void
    {
        if ($reservation->placesAcquises()) {
            return;
        }
        $sortie = $reservation->getSortie();
        if ($sortie !== null && $reservation->getNombrePlaces() > 0) {
            $sortie->decrementerPlaces($reservation->getNombrePlaces());
        }
        $reservation->setPlacesAcquises(true);
    }

    public function commencerTentativeAcompte(Reservation $reservation, string $reference, \DateTimeImmutable $debut, \DateTimeImmutable $expiration): void
    {
        if ($debut >= $expiration || $reservation->getEtat() === 'expirée') {
            throw new PaiementRefuseException('Nouvelle tentative refusée après expiration.');
        }
        $this->tentativesAcompte[$reference] = ['reservation' => $reservation, 'debut' => $debut, 'expiration' => $expiration];
    }

    public function confirmerTentativeAcompte(string $reference, float $montant): Paiement
    {
        if (isset($this->operations[$reference])) {
            return $this->operations[$reference];
        }
        $tentative = $this->tentativesAcompte[$reference] ?? null;
        if ($tentative === null) {
            throw new PaiementRefuseException('Aucune tentative valide.');
        }
        return $this->confirmerAcompte($tentative['reservation'], $montant, $reference) ?? throw new PaiementRefuseException();
    }

    public function libererSiExpire(Sortie $sortie, \DateTimeImmutable $date): void
    {
        $sortie->incrementerPlaces(1);
    }

    public function modesSoldeDisponibles(Reservation $reservation, \DateTimeImmutable $maintenant): array
    {
        $date = $reservation->getSortie()?->getDate();
        if ($date === null) {
            return ['sur_place'];
        }
        $heures = ($date->getTimestamp() - $maintenant->getTimestamp()) / 3600;
        return $heures > 12 ? ['en_ligne', 'sur_place'] : ['sur_place'];
    }

    public function creerLienSolde(Reservation $reservation, \DateTimeImmutable $maintenant): ?string
    {
        return in_array('en_ligne', $this->modesSoldeDisponibles($reservation, $maintenant), true)
            ? 'SOLDE-' . spl_object_id($reservation)
            : null;
    }

    public function commencerPaiementSolde(Reservation $reservation, string $reference, \DateTimeImmutable $maintenant): void
    {
        if (!in_array('en_ligne', $this->modesSoldeDisponibles($reservation, $maintenant), true)) {
            throw new PaiementRefuseException('Paiement en ligne du solde fermé.');
        }
        $this->tentativesSolde[spl_object_id($reservation)] = ['reference' => $reference, 'etat' => 'en cours'];
    }

    public function confirmerSolde(Reservation $reservation, string $reference): Paiement
    {
        if (isset($this->operations[$reference])) {
            return $this->operations[$reference];
        }
        $tentative = $this->tentativesSolde[spl_object_id($reservation)] ?? null;
        if ($tentative === null || $tentative['reference'] !== $reference) {
            throw new PaiementRefuseException('Tentative de solde inconnue.');
        }
        $paiement = new Paiement($reservation->getSoldeRestant(), $reference, 'solde');
        $reservation->ajouterPaiement($paiement)->setStatutPaiement('intégralement payé');
        $this->tentativesSolde[spl_object_id($reservation)]['etat'] = 'confirmée';
        $this->operations[$reference] = $paiement;
        return $paiement;
    }

    public function enregistrerSoldeSurPlace(Reservation $reservation, string $reference): Paiement
    {
        if (isset($this->tentativesSolde[spl_object_id($reservation)])) {
            throw new PaiementRefuseException('Un paiement en ligne du solde existe déjà.');
        }
        if (isset($this->operations[$reference])) {
            return $this->operations[$reference];
        }
        $paiement = new Paiement($reservation->getSoldeRestant(), $reference, 'solde');
        $reservation->ajouterPaiement($paiement)->setStatutPaiement('intégralement payé');
        $this->operations[$reference] = $paiement;
        return $paiement;
    }

    public function verifierEmbarquement(Reservation $reservation): bool
    {
        if ($reservation->getStatutPaiement() !== 'intégralement payé') {
            $reservation->setEtat('annulée');
            return false;
        }
        return true;
    }

    public function nombreOperations(): int { return count($this->operations); }
}
