<?php

declare(strict_types=1);

namespace App\Service\Paiement;

use App\Entity\Document;
use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Enum\CanalPaiement;
use App\Enum\EtatReservation;
use App\Enum\StatutPaiement;
use App\Enum\TypeDocument;
use App\Enum\TypePaiement;
use App\Exception\RegleMetierException;
use Doctrine\ORM\EntityManagerInterface;

final class SoldeService
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    public function paiementEnLigneOuvert(Reservation $reservation, ?\DateTimeImmutable $maintenant = null): bool
    {
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        $secondes = $reservation->getSortie()->getDepart()->getTimestamp() - $maintenant->getTimestamp();
        return $reservation->getEtat() === EtatReservation::RESERVEE
            && Montant::enCentimes($reservation->getSolde()) > 0
            && $secondes <= 24 * 3600 && $secondes > 12 * 3600;
    }

    public function payerEnLigne(Reservation $reservation): void
    {
        if (!$this->paiementEnLigneOuvert($reservation)) {
            throw new RegleMetierException('Le paiement en ligne du solde est disponible uniquement entre H-24 et H-12.');
        }
        $this->enregistrer($reservation, CanalPaiement::EN_LIGNE, 'test_solde_web_');
    }

    public function payerSurPlace(Reservation $reservation): void
    {
        if ($reservation->getEtat() !== EtatReservation::RESERVEE || Montant::enCentimes($reservation->getSolde()) <= 0) {
            throw new RegleMetierException('Le solde ne peut pas être enregistré.');
        }
        $this->enregistrer($reservation, CanalPaiement::SUR_PLACE, 'test_solde_place_');
    }

    private function enregistrer(Reservation $reservation, CanalPaiement $canal, string $prefixe): void
    {
        $paiement = (new Paiement())->setType(TypePaiement::SOLDE)->setCanal($canal)->setMontant($reservation->getSolde())
            ->setReferenceExterne($prefixe.bin2hex(random_bytes(8)))->confirmer();
        $reservation->addPaiement($paiement)->setSolde('0.00')->setStatutPaiement(StatutPaiement::INTEGRALEMENT_PAYE);
        $document = (new Document())->setType(TypeDocument::FACTURE_FINALE)->setReference('FAC-'.strtoupper(bin2hex(random_bytes(5))));
        $reservation->setDocument($document);
        $this->em->persist($document);
        $this->em->flush();
    }
}
