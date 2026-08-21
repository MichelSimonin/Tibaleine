<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Sortie;
use App\Enum\TypeSortie;
use App\Exception\RegleMetierException;
use App\Repository\TarifRepository;
use App\Service\Paiement\Montant;

final class TarificationService
{
    public function __construct(private readonly TarifRepository $tarifs) {}

    public function calculer(Sortie $sortie, int $adultes, int $enfants): string
    {
        $type = $sortie->getType();
        if ($type === null) { throw new RegleMetierException('Le type de sortie doit être sélectionné avant le calcul du tarif.'); }
        if ($type === TypeSortie::PRIVATISATION) {
            $tarif = $this->tarifs->findOneBy(['typeSortie' => TypeSortie::PRIVATISATION, 'bateau' => $sortie->getBateau()]);
            if ($tarif === null) { throw new RegleMetierException('Tarif de privatisation introuvable.'); }
            return $tarif->getMontant();
        }

        $adulte = $this->tarifs->findOneBy(['typeSortie' => $type, 'categorie' => 'adulte']);
        $enfant = $this->tarifs->findOneBy(['typeSortie' => $type, 'categorie' => 'enfant']);
        if ($adulte === null || $enfant === null) { throw new RegleMetierException('Tarifs de la sortie introuvables.'); }

        $total = Montant::enCentimes($adulte->getMontant()) * $adultes
            + Montant::enCentimes($enfant->getMontant()) * $enfants;
        return Montant::depuisCentimes($total);
    }
}
