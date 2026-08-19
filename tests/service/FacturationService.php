<?php
declare(strict_types=1);
namespace App\Service;
use App\Entity\Facture;
use App\Entity\Reservation;
use App\Entity\Utilisateur;

final class FacturationService
{
    public function facturerHotel(Utilisateur $hotel, array $reservations): Facture { $montant = array_sum(array_map(fn (Reservation $r) => $r->getEtat() === 'annulée' ? 0.0 : $r->getMontantTotal(), $reservations)); return new Facture($montant, $montant * 0.85); }
}