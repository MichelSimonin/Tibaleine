<?php
declare(strict_types=1);
namespace App\Repository;
use App\Entity\Tarif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<Tarif> */
final class TarifRepository extends ServiceEntityRepository { public function __construct(ManagerRegistry $r) { parent::__construct($r, Tarif::class); } }
