<?php

declare(strict_types=1);

namespace App\Entity;

final class Sortie
{
    private ?\DateTimeImmutable $date = null;
    private ?\DateTimeImmutable $avertissementEnvoye = null;
    private int $placesRestantes = 0;
    private bool $alerteAffichee = false;
    private bool $hotelAAppeler = false;
    private bool $badgeNouvellePlace = false;
    private string $etat = 'ouverte';
    private array $reservations = [];

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setAvertissementEnvoye(\DateTimeImmutable $date): self
    {
        $this->avertissementEnvoye = $date;

        return $this;
    }

    public function getAvertissementEnvoye(): ?\DateTimeImmutable
    {
        return $this->avertissementEnvoye;
    }

    public function addReservation(Reservation $reservation): self
    {
        $this->reservations[] = $reservation;
        if ($reservation->getSortie() !== $this) {
            $reservation->setSortie($this);
        }

        return $this;
    }

    public function getReservations(): array
    {
        return $this->reservations;
    }

    public function setPlacesRestantes(int $places): self
    {
        $this->placesRestantes = $places;

        return $this;
    }

    public function getPlacesRestantes(): int
    {
        return $this->placesRestantes;
    }

    public function decrementerPlaces(int $places): self
    {
        if ($places < 0 || $places > $this->placesRestantes) {
            throw new \LogicException('Places insuffisantes.');
        }
        $this->placesRestantes -= $places;

        return $this;
    }

    public function incrementerPlaces(int $places): self
    {
        $this->placesRestantes += $places;
        $this->badgeNouvellePlace = true;

        return $this;
    }

    public function afficherAlerte(): self
    {
        $this->alerteAffichee = true;

        return $this;
    }

    public function alerteAffichee(): bool
    {
        return $this->alerteAffichee;
    }

    public function appelerHotel(): self
    {
        $this->hotelAAppeler = true;

        return $this;
    }

    public function hotelAAppeler(): bool
    {
        return $this->hotelAAppeler;
    }

    public function alerteMeteoVisible(): bool
    {
        return $this->avertissementEnvoye !== null;
    }

    public function badgeNouvellePlace(): bool
    {
        return $this->badgeNouvellePlace;
    }

    public function setEtat(string $etat): self { $this->etat = $etat; return $this; }
    public function getEtat(): string { return $this->etat; }
}
