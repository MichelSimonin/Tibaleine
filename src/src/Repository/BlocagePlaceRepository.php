<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BlocagePlace;
use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<BlocagePlace> */
final class BlocagePlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry) { parent::__construct($registry, BlocagePlace::class); }

    public function countActiveSeats(Sortie $sortie, \DateTimeImmutable $maintenant, ?BlocagePlace $ignorer = null): int
    {
        $qb = $this->createQueryBuilder('b')->select('COALESCE(SUM(b.nombrePlaces), 0)')
            ->andWhere('b.sortie = :sortie')->andWhere('b.expireLe > :maintenant')
            ->setParameter('sortie', $sortie)->setParameter('maintenant', $maintenant);
        if ($ignorer !== null && $ignorer->getId() !== null) { $qb->andWhere('b != :ignorer')->setParameter('ignorer', $ignorer); }
        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    public function deleteExpired(\DateTimeImmutable $maintenant): int
    {
        return $this->createQueryBuilder('b')->delete()->andWhere('b.expireLe <= :maintenant')
            ->setParameter('maintenant', $maintenant)->getQuery()->execute();
    }

    /** @return list<BlocagePlace> */
    public function findExpired(\DateTimeImmutable $maintenant): array
    {
        return $this->createQueryBuilder('b')->addSelect('s')->join('b.sortie', 's')
            ->andWhere('b.expireLe <= :maintenant')->setParameter('maintenant', $maintenant)
            ->getQuery()->getResult();
    }
}
