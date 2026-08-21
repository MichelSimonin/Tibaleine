<?php

declare(strict_types=1);

namespace App\Service\Paiement;

use App\Entity\Paiement;
use App\Entity\Reservation;
use App\Enum\StatutOperation;
use App\Enum\TypePaiement;
use App\Exception\RegleMetierException;
use App\Repository\PaiementRepository;
use Doctrine\ORM\EntityManagerInterface;

final class ComplementService
{
    public function __construct(private readonly EntityManagerInterface $em, private readonly PaiementRepository $paiements) {}
    public function complementEnAttente(Reservation $reservation): ?Paiement
    {
        return $this->paiements->findOneBy(['reservation' => $reservation, 'type' => TypePaiement::COMPLEMENT, 'statut' => StatutOperation::EN_ATTENTE]);
    }
    public function payer(Reservation $reservation, ?\DateTimeImmutable $maintenant = null): Paiement
    {
        $paiement = $this->complementEnAttente($reservation);
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($paiement === null || $paiement->getDateInitiation()->modify('+24 hours') <= $maintenant) {
            throw new RegleMetierException('Le lien de complément est absent ou expiré. Le règlement reste possible sur place.');
        }
        $paiement->confirmer();
        $this->em->flush();
        return $paiement;
    }
}
