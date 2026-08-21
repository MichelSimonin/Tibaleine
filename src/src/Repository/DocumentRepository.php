<?php
declare(strict_types=1);
namespace App\Repository;
use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/** @extends ServiceEntityRepository<Document> */
final class DocumentRepository extends ServiceEntityRepository { public function __construct(ManagerRegistry $r) { parent::__construct($r, Document::class); } }
