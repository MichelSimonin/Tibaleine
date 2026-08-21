<?php
declare(strict_types=1);
namespace App\Repository;
use App\Entity\Paiement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<Paiement> */
final class PaiementRepository extends ServiceEntityRepository { public function __construct(ManagerRegistry $r) { parent::__construct($r, Paiement::class); } }
