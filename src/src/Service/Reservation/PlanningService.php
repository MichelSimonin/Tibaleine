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
        $duree = match ($type) { TypeSortie::BALEINE => '02:30', TypeSortie::DAUPHIN => '02:00', TypeSortie::PRIVATISATION => '03:00' };
        $sortie = (new Sortie())->setType($type)->setDate($date)->setHeureDepart($heure)->setDuree(new \DateTimeImmutable($duree, $heure->getTimezone()))->setBateau($bateau);
        $this->em->persist($sortie);
        $this->em->flush();
        return $sortie;
    }
}
