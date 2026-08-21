<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\Reservation\BlocagePlacesService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:cleanup-blocks', description: 'Libère les blocages de places expirés.')]
final class CleanupBlocksCommand extends Command
{
    public function __construct(private readonly BlocagePlacesService $blocages) { parent::__construct(); }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(sprintf('<info>%d blocage(s) expiré(s) libéré(s).</info>', $this->blocages->nettoyer()));
        return Command::SUCCESS;
    }
}
