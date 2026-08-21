<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Bateau;
use App\Entity\Sortie;
use App\Enum\TypeSortie;
use App\Exception\RegleMetierException;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PlanningService
{
    public function __construct(private readonly EntityManagerInterface $em, private readonly SortieRepository $sorties) {}

    public function creer(TypeSortie $type, \DateTimeImmutable $date, \DateTimeImmutable $heure, Bateau $bateau): Sortie
    {
        if (!in_array($bateau->getCapacite(), [12, 24], true)) { throw new RegleMetierException('La capacité du bateau doit être 12 ou 24.'); }
        if ($type === TypeSortie::BALEINE && $this->sorties->findOneBy(['type' => TypeSortie::BALEINE, 'date' => $date, 'heureDepart' => $heure]) !== null) {
            throw new RegleMetierException('Une seule sortie baleine est autorisée sur ce créneau.');
        }
        $creneau = $this->sorties->findOneBy(['date' => $date, 'heureDepart' => $heure, 'bateau' => $bateau]);
        if ($creneau !== null && $creneau->getType() !== null) {
            throw new RegleMetierException('Ce bateau est déjà affecté sur ce créneau.');
        }
        $sortiesDuCreneau = $this->sorties->findBy(['date' => $date, 'heureDepart' => $heure]);
        if ($type === TypeSortie::PRIVATISATION && array_filter($sortiesDuCreneau, static fn (Sortie $sortie): bool => $sortie->getType() !== null)) {
            throw new RegleMetierException('La privatisation est impossible lorsqu’une autre sortie est déjà affectée au créneau.');
        }
        if ($type !== TypeSortie::PRIVATISATION && array_filter($sortiesDuCreneau, static fn (Sortie $sortie): bool => $sortie->getType() === TypeSortie::PRIVATISATION)) {
            throw new RegleMetierException('Ce créneau est déjà réservé à une privatisation.');
        }
        $sortie = ($creneau ?? (new Sortie())->setDate($date)->setHeureDepart($heure)->setBateau($bateau))->setType($type);
        $this->em->persist($sortie);
        $this->em->flush();
        return $sortie;
    }
}
