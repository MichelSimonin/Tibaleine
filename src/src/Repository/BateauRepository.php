<?php
declare(strict_types=1);
namespace App\Repository;
use App\Entity\Bateau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<Bateau> */
final class BateauRepository extends ServiceEntityRepository { public function __construct(ManagerRegistry $r) { parent::__construct($r, Bateau::class); } }
