<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/** @extends ServiceEntityRepository<Utilisateur> */
final class UtilisateurRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry) { parent::__construct($registry, Utilisateur::class); }
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if ($user instanceof Utilisateur) {
            $user->setPassword($newHashedPassword);
            $this->getEntityManager()->flush();
        }
    }
}
