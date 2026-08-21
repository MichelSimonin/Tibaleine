<?php
declare(strict_types=1);
namespace App\Repository;
use App\Entity\Reservation;
use App\Entity\Sortie;
use App\Enum\EtatReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<Reservation> */
final class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $r) { parent::__construct($r, Reservation::class); }
    public function countReservedSeats(Sortie $sortie): int
    {
        return (int) $this->createQueryBuilder('r')->select('COALESCE(SUM(r.nbAdultes + r.nbEnfants), 0)')
            ->andWhere('r.sortie = :sortie')->andWhere('r.etat != :annulee')
            ->setParameter('sortie', $sortie)->setParameter('annulee', EtatReservation::ANNULEE)
            ->getQuery()->getSingleScalarResult();
    }
}
