# Application Symfony TI Baleine

Ce dossier contient l'application Symfony et son environnement local Docker.
Au premier démarrage, Symfony 7.4 LTS et le pack web sont installés
automatiquement si aucun `composer.json` n'est présent.

## Démarrage

Prérequis : Docker Desktop doit être installé et démarré.

Depuis le dossier `src` :

```bash
docker compose up --build
```

Depuis la racine du dépôt sous Linux ou macOS :

```bash
docker compose -f src/compose.yaml up --build
```

Depuis la racine du dépôt sous Windows, dans PowerShell :

```powershell
docker compose -f .\src\compose.yaml up --build
```

L'application est ensuite disponible sur <http://localhost:8026>. PostgreSQL
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

## Dépannage sous Windows

Les conteneurs utilisent Linux. Les scripts `.sh` doivent donc avoir des fins
de ligne LF et non CRLF. Le fichier `.gitattributes` placé à la racine du dépôt
impose automatiquement le format LF lors des prochains clones et extractions
Git. Le Dockerfile normalise également les scripts au moment de la construction.

Après avoir récupéré cette correction, reconstruisez complètement l'image dans
PowerShell, depuis la racine du dépôt :

```powershell
git pull
docker compose -f .\src\compose.yaml down
docker compose -f .\src\compose.yaml build --no-cache
docker compose -f .\src\compose.yaml up
```

Si l'application ne démarre toujours pas, affichez les journaux du service
d'initialisation :

```powershell
docker compose -f .\src\compose.yaml logs init
```

Une erreur telle que `/usr/bin/env: 'bash\r': No such file or directory` ou un
code de sortie `127` signale généralement un ancien script en CRLF. Vérifiez
aussi dans VS Code que `src/.docker/init-project.sh` et
`src/.docker/run-worker.sh` affichent `LF` en bas à droite, puis relancez la
reconstruction avec `--no-cache`.
