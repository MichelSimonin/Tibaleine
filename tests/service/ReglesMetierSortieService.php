<?php

declare(strict_types=1);

namespace App\Service;

final class ReglesMetierSortieService
{
    public function capaciteBateau(string $bateau): int
    {
        return match ($bateau) {
            'ti_kap' => 12,
            'grand_bleu' => 24,
            default => throw new \InvalidArgumentException('Bateau inconnu.'),
        };
    }

    public function nombreReservationValide(int $nombre, string $bateau): bool
    {
        return $nombre >= 2 && $nombre <= $this->capaciteBateau($bateau);
    }

    public function sortieMaintenue(int $nombrePassagers, int $nombreBateaux = 1): bool
    {
        if ($nombreBateaux < 1) {
            throw new \InvalidArgumentException('Le nombre de bateaux doit être positif.');
        }

        return $nombrePassagers >= 6 * $nombreBateaux;
    }

    public function categorieTarif(int $age): string
    {
        if ($age < 4) {
            throw new \LogicException('Les enfants de moins de 4 ans ne sont pas autorisés.');
        }

        return $age < 12 ? 'enfant' : 'adulte';
    }

    public function calculerTarif(string $type, array $ages = [], ?string $bateau = null): float
    {
        if ($type === 'privatisation') {
            return match ($bateau) {
                'ti_kap' => 600.0,
                'grand_bleu' => 1100.0,
                default => throw new \InvalidArgumentException('Bateau requis pour une privatisation.'),
            };
        }

        $tarifs = match ($type) {
            'baleine' => ['adulte' => 65.0, 'enfant' => 40.0],
            'dauphin' => ['adulte' => 50.0, 'enfant' => 30.0],
            default => throw new \InvalidArgumentException('Type de sortie inconnu.'),
        };

        return array_sum(array_map(
            fn (int $age): float => $tarifs[$this->categorieTarif($age)],
            $ages,
        ));
    }

    public function creneauxHabituels(): array
    {
        return ['07:00', '10:00', '14:00'];
    }

    public function dureeMinutes(string $type): int
    {
        return match ($type) {
            'baleine' => 150,
            'dauphin' => 120,
            default => throw new \InvalidArgumentException('Type de sortie inconnu.'),
        };
    }

    public function privatisationPossibleLeMatin(string $heure): bool
    {
        return $heure >= '00:00' && $heure < '12:00';
    }

    public function peutAjouterSortieBaleine(array $typesDejaProgrammes): bool
    {
        return !in_array('baleine', $typesDejaProgrammes, true);
    }

    public function departsSynchronises(\DateTimeImmutable $premier, \DateTimeImmutable $second): bool
    {
        return $premier == $second;
    }
}
