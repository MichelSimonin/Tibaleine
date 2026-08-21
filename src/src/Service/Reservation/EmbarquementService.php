<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Reservation;
use App\Enum\EtatReservation;
use App\Enum\StatutPaiement;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;
use Doctrine\ORM\EntityManagerInterface;

final class EmbarquementService
{
    public function __construct(private readonly EntityManagerInterface $em) {}
    public function enregistrerParticipation(Reservation $reservation): void
    {
        if ($reservation->getEtat() !== EtatReservation::RESERVEE) { throw new RegleMetierException('La réservation n’est pas en état d’embarquer.'); }
        $hotel = $reservation->getUtilisateur()->getRoleMetier() === UserRole::HOTEL;
        if (!$hotel && $reservation->getStatutPaiement() !== StatutPaiement::INTEGRALEMENT_PAYE) {
            $reservation->setEtat(EtatReservation::ANNULEE)->setMotifAnnulation('Embarquement refusé : solde impayé.');
            $this->em->flush();
            throw new RegleMetierException('Embarquement refusé : le solde exigible est impayé.');
        }
        $reservation->setEtat(EtatReservation::REALISEE);
        $this->em->flush();
    }
}
