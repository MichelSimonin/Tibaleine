<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Entity\Supplement;
use App\Entity\Remboursement;
use App\Entity\Utilisateur;

final class ReservationService
{
    private array $blocages = [];

    public function reserver(Reservation $reservation): Reservation
    {
        $reservation->setEtat('en attente')->setPaiementAcompteRequis(true);
        return $reservation;
    }

    public function reserverPourHotel(array $creneaux): array
    {
        $reussies = [];
        $echouees = [];
        foreach ($creneaux as $creneau) {
            $nombre = (int) ($creneau['nb'] ?? 0);
            $disponibles = (int) ($creneau['disponibles'] ?? 6);
            if ($nombre > 0 && $nombre <= 6 && $nombre <= $disponibles) {
                $reussies[] = $creneau;
            } else {
                $echouees[] = $creneau;
            }
        }
        return ['reussies' => $reussies, 'echouees' => $echouees];
    }

    public function reserverHotel(Utilisateur $hotel, Sortie $sortie, int $nombre, bool $privatisation = false): Reservation
    {
        if ($hotel->getRole() !== 'hotel' || $privatisation || $nombre < 1 || $nombre > 6) {
            throw new \LogicException('Réservation hôtel refusée.');
        }
        $reservation = (new Reservation())
            ->setUtilisateur($hotel)
            ->setSortie($sortie)
            ->setNbAdultes($nombre)
            ->setEtat('réservée')
            ->setStatutPaiement('en attente de paiement')
            ->setPaiementAcompteRequis(false)
            ->setPlacesAcquises(true);
        $sortie->decrementerPlaces($nombre)->addReservation($reservation);
        return $reservation;
    }

    public function bloquerPlace(Sortie $sortie, int $nombre, \DateTimeImmutable $date): void
    {
        $sortie->decrementerPlaces($nombre);
        $this->blocages[spl_object_id($sortie)] = ['nombre' => $nombre, 'date' => $date, 'phase' => 'formulaire'];
    }

    public function passerAuPaiement(Sortie $sortie, \DateTimeImmutable $date): void
    {
        $id = spl_object_id($sortie);
        $blocage = $this->blocages[$id] ?? null;
        if ($blocage === null || $date->getTimestamp() - $blocage['date']->getTimestamp() >= 900) {
            throw new \LogicException('Le premier délai est expiré.');
        }
        $this->blocages[$id]['date'] = $date;
        $this->blocages[$id]['phase'] = 'paiement';
    }

    public function libererSiExpire(Sortie $sortie, \DateTimeImmutable $date): void
    {
        $id = spl_object_id($sortie);
        $blocage = $this->blocages[$id] ?? null;
        if ($blocage !== null && $date->getTimestamp() - $blocage['date']->getTimestamp() >= 900) {
            $sortie->incrementerPlaces($blocage['nombre']);
            unset($this->blocages[$id]);
        }
    }

    public function blocageActif(Sortie $sortie): bool { return isset($this->blocages[spl_object_id($sortie)]); }
    public function phaseBlocage(Sortie $sortie): ?string { return $this->blocages[spl_object_id($sortie)]['phase'] ?? null; }

    public function reserverSiDisponible(Reservation $reservation): bool
    {
        $sortie = $reservation->getSortie();
        if ($sortie === null || $reservation->getNombrePlaces() < 1 || $sortie->getPlacesRestantes() < $reservation->getNombrePlaces()) {
            return false;
        }
        $sortie->decrementerPlaces($reservation->getNombrePlaces())->addReservation($reservation);
        $reservation->setEtat('réservée')->setPlacesAcquises(true);
        return true;
    }

    public function canalDemandeModification(Reservation $reservation): string { return 'telephone'; }

    public function modifier(Reservation $reservation, array $modifications): Reservation
    {
        if (isset($modifications['ajouter_adultes'])) {
            $reservation->setNbAdultes($reservation->getNbAdultes() + (int) $modifications['ajouter_adultes']);
        }
        if (isset($modifications['montant_courant'])) {
            $reservation->setMontantCourant((float) $modifications['montant_courant']);
        }
        return $reservation;
    }

    public function ajouterParticipant(Reservation $reservation, int $nombre, ?float $nouveauMontant = null): Supplement
    {
        $reservation->setNbAdultes($reservation->getNbAdultes() + $nombre);
        if ($nouveauMontant !== null) {
            $reservation->setMontantCourant($nouveauMontant);
        }
        return new Supplement(true, false);
    }

    public function supprimerParticipant(Reservation $reservation, int $nombre, ?float $nouveauMontant = null): Remboursement
    {
        $reservation->setNbAdultes(max(0, $reservation->getNbAdultes() - $nombre));
        if ($nouveauMontant !== null) {
            $reservation->setMontantCourant($nouveauMontant);
        }
        return new Remboursement($reservation->getTropPercu());
    }

    public function modifierSousContraintes(Reservation $reservation, float $nouveauMontant, bool $capaciteDisponible, bool $dansDelai): void
    {
        if (!$capaciteDisponible || !$dansDelai) {
            throw new \LogicException('Modification refusée.');
        }
        $reservation->setMontantCourant($nouveauMontant);
    }
}
