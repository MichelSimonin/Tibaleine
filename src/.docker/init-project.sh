#!/bin/sh

set -eu

project_dir=/var/www/html

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
fi
