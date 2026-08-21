#!/bin/sh

set -eu

project_dir=/var/www/html

# Un volume Docker neuf appartient à root. Corrige ses droits, puis reprends
# l'initialisation avec l'utilisateur applicatif pour conserver des fichiers
# modifiables aussi bien depuis Linux que depuis Docker Desktop sous Windows.
if [ "$(id -u)" -eq 0 ]; then
    chown -R "${APP_UID:-1000}:${APP_GID:-1000}" "${project_dir}/vendor"
    exec setpriv \
        --reuid="${APP_UID:-1000}" \
        --regid="${APP_GID:-1000}" \
        --init-groups \
        /usr/local/bin/init-project "$@"
fi

if [ ! -f "${project_dir}/composer.json" ]; then
    temporary_dir="$(mktemp -d)"
    trap 'rm -rf "${temporary_dir}"' EXIT HUP INT TERM

    composer create-project symfony/skeleton:"7.4.*" "${temporary_dir}" \
        --no-interaction \
        --no-progress
    composer --working-dir="${temporary_dir}" require webapp \
        --no-interaction \
        --no-progress

    # Conserve les fichiers Docker et la documentation déjà présents.
    cp -a -n "${temporary_dir}/." "${project_dir}/"
fi

cd "${project_dir}"

composer install --no-interaction --prefer-dist --no-progress

if [ -f bin/console ]; then
    php bin/console doctrine:database:create --if-not-exists --no-interaction
    php bin/console doctrine:migrations:migrate \
        --no-interaction \
        --allow-no-migration
    php bin/console app:seed-demo --no-interaction

    php bin/console doctrine:database:create --env=test --if-not-exists --no-interaction
    php bin/console doctrine:migrations:migrate --env=test \
        --no-interaction \
        --allow-no-migration
    php bin/console app:seed-demo --env=test --no-interaction
fi
