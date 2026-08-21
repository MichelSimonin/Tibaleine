<?php
declare(strict_types=1);
namespace App\Repository;
use App\Entity\Sortie;
use Doctrine\DBAL\LockMode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<Sortie> */
final class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $r) { parent::__construct($r, Sortie::class); }
    /** @return list<Sortie> */
    public function findForWeek(\DateTimeImmutable $start): array
    {
        $end = $start->modify('+7 days');
        return $this->createQueryBuilder('s')->addSelect('b')->join('s.bateau', 'b')
            ->andWhere('s.date >= :start')->andWhere('s.date < :end')
            ->setParameter('start', $start)->setParameter('end', $end)
            ->orderBy('s.date', 'ASC')->addOrderBy('s.heureDepart', 'ASC')->addOrderBy('b.capacite', 'DESC')->getQuery()->getResult();
    }

    /** @return list<Sortie> */
    public function findUpcoming(\DateTimeImmutable $from, int $days = 14): array
    {
        return $this->createQueryBuilder('s')->addSelect('b', 'r')->join('s.bateau', 'b')->leftJoin('s.reservations', 'r')
            ->andWhere('s.date >= :from')->andWhere('s.date < :end')
            ->andWhere('s.type IS NOT NULL')
            ->setParameter('from', $from->setTime(0, 0))->setParameter('end', $from->modify("+{$days} days")->setTime(0, 0))
            ->orderBy('s.date', 'ASC')->addOrderBy('s.heureDepart', 'ASC')->getQuery()->getResult();
    }

    /** @return list<Sortie> */
    public function findForCreneau(Sortie $reference, bool $verrouiller = false): array
    {
        $query = $this->createQueryBuilder('s')->addSelect('b')->join('s.bateau', 'b')
            ->andWhere('s.date = :date')->andWhere('s.heureDepart = :heure')
            ->setParameter('date', $reference->getDate())->setParameter('heure', $reference->getHeureDepart())
            ->orderBy('b.capacite', 'DESC')->getQuery();
        if ($verrouiller) { $query->setLockMode(LockMode::PESSIMISTIC_WRITE); }
        return $query->getResult();
    }
}
