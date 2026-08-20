<?php

declare(strict_types=1);

namespace App\Service;

final class ValidationReservationService
{
    private const CHAMPS_REQUIS = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'type',
        'date',
        'heure',
        'nb_adultes',
        'nb_enfants',
    ];

    public function valider(array $donnees): bool
    {
        foreach (self::CHAMPS_REQUIS as $champ) {
            if (!array_key_exists($champ, $donnees) || $donnees[$champ] === '') {
                throw new \InvalidArgumentException("Champ obligatoire manquant : {$champ}.");
            }
        }

        if (filter_var($donnees['email'], FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Adresse email invalide.');
        }
        if (preg_match('/^[+0-9 .-]{8,20}$/', (string) $donnees['telephone']) !== 1) {
            throw new \InvalidArgumentException('Numéro de téléphone invalide.');
        }
        if (!in_array($donnees['type'], ['baleine', 'dauphin', 'privatisation'], true)) {
            throw new \InvalidArgumentException('Type de sortie invalide.');
        }
        if ((int) $donnees['nb_adultes'] < 0 || (int) $donnees['nb_enfants'] < 0
            || (int) $donnees['nb_adultes'] + (int) $donnees['nb_enfants'] < 2) {
            throw new \InvalidArgumentException('La réservation doit concerner au moins deux personnes.');
        }

        return true;
    }
}
