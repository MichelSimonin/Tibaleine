<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Exception\PaiementRefuseException;

final class PaiementService
{
    public function payer(Reservation $reservation): Paiement { if ($reservation->getMontantTotal() <= 0.0) { throw new PaiementRefuseException(); } $reservation->setEtat('payée'); $sortie = $reservation->getSortie(); if ($sortie !== null) { $sortie->decrementerPlaces($reservation->getNbAdultes() + $reservation->getNbEnfants()); } return new Paiement($reservation->getMontantTotal()); }
    public function libererSiExpire(Sortie $sortie, \DateTimeImmutable $date): void { $sortie->incrementerPlaces(1); }
}