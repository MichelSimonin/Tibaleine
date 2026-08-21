#!/bin/sh

set -eu

cd /var/www/html
while true; do
    php bin/console app:notify-balances --no-interaction
    sleep 60
done
