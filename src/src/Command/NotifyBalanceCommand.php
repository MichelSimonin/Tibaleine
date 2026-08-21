<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Notification;
use App\Entity\Reservation;
use App\Enum\EtatReservation;
use App\Enum\TypeNotification;
use App\Service\Notification\NotificationService;
use App\Service\Paiement\SoldeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:notify-balances', description: 'Trace une seule fois les liens de solde ouverts entre H-24 et H-12.')]
final class NotifyBalanceCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SoldeService $soldes,
        private readonly NotificationService $notifications,
    ) { parent::__construct(); }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $reservations = $this->em->getRepository(Reservation::class)->findBy(['etat' => EtatReservation::RESERVEE]);
        $notificationRepository = $this->em->getRepository(Notification::class);
        $nombre = 0;
        foreach ($reservations as $reservation) {
            if (!$this->soldes->paiementEnLigneOuvert($reservation)
                || $notificationRepository->findOneBy(['reservation' => $reservation, 'type' => TypeNotification::LIEN_SOLDE]) !== null) {
                continue;
            }
            $this->notifications->tracerLienSolde($reservation);
            ++$nombre;
        }
        $this->em->flush();
        $output->writeln(sprintf('<info>%d lien(s) de solde tracé(s).</info>', $nombre));
        return Command::SUCCESS;
    }
}
