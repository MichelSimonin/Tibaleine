<?php

declare(strict_types=1);

namespace App\Service\Facturation;

use App\Entity\Document;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Entity\Utilisateur;
use App\Enum\CanalPaiement;
use App\Enum\EtatReservation;
use App\Enum\StatutPaiement;
use App\Enum\TypeDocument;
use App\Enum\TypePaiement;
use App\Enum\UserRole;
use App\Exception\RegleMetierException;
use App\Service\Paiement\Montant;
use Doctrine\ORM\EntityManagerInterface;

final class FacturationHotelService
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function generer(Utilisateur $hotel, \DateTimeImmutable $mois): Document
    {
        if ($hotel->getRoleMetier() !== UserRole::HOTEL) { throw new RegleMetierException('Le compte sélectionné n’est pas un hôtel.'); }
        $reference = sprintf('HOTEL-%s-%d', $mois->format('Y-m'), $hotel->getId());
        $existant = $this->em->getRepository(Document::class)->findOneBy(['reference' => $reference]);
        if ($existant !== null) { return $existant; }
        $debut = $mois->modify('first day of this month')->setTime(0, 0);
        $fin = $debut->modify('+1 month');
        $reservations = $this->em->createQueryBuilder()->select('r', 's')->from(Reservation::class, 'r')->join('r.sortie', 's')
            ->andWhere('r.utilisateur = :hotel')->andWhere('r.etat != :annulee')
            ->andWhere('s.date >= :debut')->andWhere('s.date < :fin')
            ->setParameter('hotel', $hotel)->setParameter('annulee', EtatReservation::ANNULEE)
            ->setParameter('debut', $debut)->setParameter('fin', $fin)->getQuery()->getResult();
        if ($reservations === []) { throw new RegleMetierException('Aucune réservation à facturer pour ce mois.'); }
        $total = 0;
        $document = (new Document())->setType(TypeDocument::FACTURE_HOTEL_MENSUELLE)->setReference($reference);
        foreach ($reservations as $reservation) {
            $montantRemise = (int) round(Montant::enCentimes($reservation->getMontantCourant()) * 0.85, 0, PHP_ROUND_HALF_UP);
            $reservation->setMontantCourant(Montant::depuisCentimes($montantRemise))->setSolde(Montant::depuisCentimes($montantRemise))->addDocument($document);
            $total += $montantRemise;
        }
        $document->setMontant(Montant::depuisCentimes($total));
        $this->em->persist($document);
        $this->em->flush();
        return $document;
    }

    public function enregistrerReglement(Document $facture): void
    {
        if ($facture->getType() !== TypeDocument::FACTURE_HOTEL_MENSUELLE) { throw new RegleMetierException('Ce document n’est pas une facture hôtel.'); }
        foreach ($facture->getReservations() as $reservation) {
            if ($reservation->getStatutPaiement() === StatutPaiement::INTEGRALEMENT_PAYE) { continue; }
            $reservation->addPaiement((new Paiement())->setType(TypePaiement::SOLDE)->setCanal(CanalPaiement::SUR_PLACE)
                ->setMontant($reservation->getSolde())->setReferenceExterne('hotel_'.$facture->getReference().'_'.$reservation->getId())->confirmer())
                ->setSolde('0.00')->setStatutPaiement(StatutPaiement::INTEGRALEMENT_PAYE);
        }
        $this->em->flush();
    }
}
