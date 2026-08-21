# Application Symfony TI Baleine

Ce dossier contient l'application Symfony et son environnement local Docker.
Au premier démarrage, Symfony 7.4 LTS et le pack web sont installés
automatiquement si aucun `composer.json` n'est présent.

## Démarrage

Depuis ce dossier :

```bash
docker compose up --build
```

Sous Windows, la commande est identique dans PowerShell :

```powershell
docker compose up --build
```

L'application est ensuite disponible sur <http://localhost:8000>. PostgreSQL
est accessible depuis la machine sur le port `5433` et sur le port `5432` entre
les conteneurs. Le code généré reste dans ce dossier et les
données PostgreSQL sont conservées dans un volume Docker.

Le démarrage applique les migrations, crée les bases de développement et de
test, charge quatre semaines de sorties et lance le traitement périodique des
liens de paiement du solde. Aucune installation locale de PHP, Composer,
Symfony ou PostgreSQL n'est nécessaire.

## Comptes de démonstration

Tous les comptes utilisent le mot de passe `Test1234!` :

| Profil | Adresse |
|---|---|
| Client | `client@tibaleine.test` |
| Hôtel | `hotel@tibaleine.test` |
| Employé (lecture seule) | `employe@tibaleine.test` |
| Patron | `admin@tibaleine.test` |

Les ports et identifiants locaux peuvent être surchargés sans modifier
`compose.yaml` : `APP_PORT`, `POSTGRES_PORT`, `POSTGRES_DB`, `POSTGRES_USER` et
`POSTGRES_PASSWORD`. Ces valeurs sont prévues pour le développement local et ne
doivent pas être réutilisées en production.

## Commandes utiles

```bash
docker compose exec app php bin/console about
docker compose exec app php bin/console doctrine:migrations:migrate
docker compose exec app vendor/bin/phpunit
docker compose exec app php bin/console app:seed-demo
docker compose exec app php bin/console app:notify-balances
docker compose down
```

Depuis la racine du dépôt, les mêmes commandes utilisent l'option
`-f src/compose.yaml`, par exemple :

```powershell
docker compose -f .\src\compose.yaml exec app vendor/bin/phpunit
php .\tools\test-runner.php
```

`docker compose down` arrête les services sans supprimer la base. La suppression
du volume PostgreSQL doit rester une action explicite.
