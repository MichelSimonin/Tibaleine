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

Les ports et identifiants locaux peuvent être surchargés sans modifier
`compose.yaml` : `APP_PORT`, `POSTGRES_PORT`, `POSTGRES_DB`, `POSTGRES_USER` et
`POSTGRES_PASSWORD`. Ces valeurs sont prévues pour le développement local et ne
doivent pas être réutilisées en production.

## Commandes utiles

```bash
docker compose exec app php bin/console about
docker compose exec app php bin/console doctrine:migrations:migrate
docker compose exec app php bin/phpunit
docker compose down
```

`docker compose down` arrête les services sans supprimer la base. La suppression
du volume PostgreSQL doit rester une action explicite.
