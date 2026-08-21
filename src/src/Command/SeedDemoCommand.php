<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Bateau;
use App\Entity\Sortie;
use App\Entity\Tarif;
use App\Entity\Utilisateur;
use App\Enum\TypeSortie;
use App\Enum\UserRole;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:seed-demo', description: 'Crée les bateaux, tarifs, comptes et sorties de démonstration de la V1.')]
final class SeedDemoCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $hasher,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $bateaux = $this->bateaux();
        $this->tarifs($bateaux);
        $this->utilisateurs();
        $sortiesCreees = $this->sorties($bateaux);
        $this->em->flush();

        $output->writeln(sprintf('<info>Données de démonstration prêtes (%d nouvelles disponibilités bateau).</info>', $sortiesCreees));
        $output->writeln('Comptes : client, hotel, employe et admin @tibaleine.test — mot de passe : Test1234!');

        return Command::SUCCESS;
    }

    /** @return array<string, Bateau> */
    private function bateaux(): array
    {
        $repository = $this->em->getRepository(Bateau::class);
        $definitions = ['Ti Kap' => 12, 'Grand Bleu' => 24];
        $bateaux = [];
        foreach ($definitions as $nom => $capacite) {
            $bateau = $repository->findOneBy(['nom' => $nom]) ?? new Bateau($nom, $capacite);
            $bateau->setCapacite($capacite);
            $this->em->persist($bateau);
            $bateaux[$nom] = $bateau;
        }
        $this->em->flush();

        return $bateaux;
    }

    /** @param array<string, Bateau> $bateaux */
    private function tarifs(array $bateaux): void
    {
        $repository = $this->em->getRepository(Tarif::class);
        $definitions = [
            [TypeSortie::BALEINE, 'adulte', null, '65.00'],
            [TypeSortie::BALEINE, 'enfant', null, '40.00'],
            [TypeSortie::DAUPHIN, 'adulte', null, '50.00'],
            [TypeSortie::DAUPHIN, 'enfant', null, '30.00'],
            [TypeSortie::PRIVATISATION, null, $bateaux['Ti Kap'], '600.00'],
            [TypeSortie::PRIVATISATION, null, $bateaux['Grand Bleu'], '1100.00'],
        ];
        foreach ($definitions as [$type, $categorie, $bateau, $montant]) {
            $criteres = ['typeSortie' => $type, 'categorie' => $categorie, 'bateau' => $bateau];
            $tarif = $repository->findOneBy($criteres) ?? (new Tarif())->setTypeSortie($type)->setCategorie($categorie)->setBateau($bateau);
            $tarif->setMontant($montant);
            $this->em->persist($tarif);
        }
    }

    private function utilisateurs(): void
    {
        $repository = $this->em->getRepository(Utilisateur::class);
        $definitions = [
            ['client@tibaleine.test', 'Camille', 'Client', UserRole::CLIENT],
            ['hotel@tibaleine.test', 'Hôtel', 'Partenaire', UserRole::HOTEL],
            ['employe@tibaleine.test', 'Emma', 'Équipage', UserRole::EMPLOYEE],
            ['admin@tibaleine.test', 'Alice', 'Patronne', UserRole::ADMIN],
        ];
        foreach ($definitions as [$email, $prenom, $nom, $role]) {
            $utilisateur = $repository->findOneBy(['email' => $email]) ?? new Utilisateur();
            $utilisateur->setEmail($email)->setPrenom($prenom)->setNom($nom)->setTelephone('0692000000')->setRoleMetier($role);
            if ($utilisateur->getPassword() === null) {
                $utilisateur->setPassword($this->hasher->hashPassword($utilisateur, 'Test1234!'));
            }
            $this->em->persist($utilisateur);
        }
    }

    /** @param array<string, Bateau> $bateaux */
    private function sorties(array $bateaux): int
    {
        $repository = $this->em->getRepository(Sortie::class);
        $timezone = new \DateTimeZone('Indian/Reunion');
        $lundi = (new \DateTimeImmutable('today', $timezone))->modify('monday this week');
        $cree = 0;
        for ($jour = 0; $jour < 28; ++$jour) {
            $date = $lundi->modify("+{$jour} days");
            foreach (['07:00', '10:00', '14:00'] as $heure) {
                foreach ($bateaux as $bateau) {
                    $existe = $repository->findOneBy([
                        'date' => $date,
                        'heureDepart' => new \DateTimeImmutable($heure, $timezone),
                        'bateau' => $bateau,
                    ]);
                    if ($existe !== null) {
                        continue;
                    }
                    $sortie = (new Sortie())
                        ->setDate($date)
                        ->setHeureDepart(new \DateTimeImmutable($heure, $timezone))
                        ->setDuree(new \DateTimeImmutable('02:00', $timezone))
                        ->setBateau($bateau);
                    $this->em->persist($sortie);
                    ++$cree;
                }
            }
        }

        return $cree;
    }
}
