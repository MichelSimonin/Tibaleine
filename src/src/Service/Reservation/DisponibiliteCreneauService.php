<?php

declare(strict_types=1);

namespace App\Service\Reservation;

use App\Entity\Bateau;
use App\Entity\Sortie;
use App\Enum\TypeSortie;
use App\Repository\BlocagePlaceRepository;
use App\Repository\ReservationRepository;

final class DisponibiliteCreneauService
{
    public function __construct(
        private readonly DisponibiliteService $disponibilite,
        private readonly ReservationRepository $reservations,
        private readonly BlocagePlaceRepository $blocages,
    ) {}

    /**
     * @param list<Sortie> $sorties
     * @return list<array{type: TypeSortie, places: int, bateau: ?Bateau}>
     */
    public function options(array $sorties, ?\DateTimeImmutable $maintenant = null, bool $hotel = false): array
    {
        if ($sorties === []) { return []; }
        $maintenant ??= new \DateTimeImmutable('now', new \DateTimeZone('Indian/Reunion'));
        if ($sorties[0]->getDepart() <= $maintenant->modify('+2 hours')) { return []; }

        $mobilisees = array_values(array_filter($sorties, fn (Sortie $sortie): bool => $this->estMobilisee($sortie, $maintenant)));
        if (array_filter($mobilisees, static fn (Sortie $sortie): bool => $sortie->getType() === TypeSortie::PRIVATISATION)) {
            return [];
        }

        $libres = array_values(array_filter($sorties, fn (Sortie $sortie): bool => !$this->estMobilisee($sortie, $maintenant)));
        $options = [];
        foreach ([TypeSortie::BALEINE, TypeSortie::DAUPHIN] as $type) {
            $affectees = array_values(array_filter($mobilisees, static fn (Sortie $sortie): bool => $sortie->getType() === $type));
            $candidates = $type === TypeSortie::BALEINE && $affectees !== [] ? $affectees : [...$affectees, ...$libres];
            $places = $this->maximumDisponible($candidates, $maintenant);
            if ($places >= 2) { $options[] = ['type' => $type, 'places' => $places, 'bateau' => null]; }
        }

        if (!$hotel && $mobilisees === []) {
            foreach ($libres as $sortie) {
                $options[] = ['type' => TypeSortie::PRIVATISATION, 'places' => $sortie->getBateau()->getCapacite(), 'bateau' => $sortie->getBateau()];
            }
        }
        return $options;
    }

    public function estMobilisee(Sortie $sortie, \DateTimeImmutable $maintenant): bool
    {
        return $sortie->getType() !== null && (
            $this->reservations->countReservedSeats($sortie) > 0
            || $this->blocages->countActiveSeats($sortie, $maintenant) > 0
        );
    }

    /** @param list<Sortie> $sorties */
    private function maximumDisponible(array $sorties, \DateTimeImmutable $maintenant): int
    {
        $maximum = 0;
        foreach ($sorties as $sortie) {
            $places = $this->estMobilisee($sortie, $maintenant)
                ? $this->disponibilite->placesRestantes($sortie, $maintenant)
                : $sortie->getBateau()->getCapacite();
            $maximum = max($maximum, $places);
        }
        return $maximum;
    }
}
