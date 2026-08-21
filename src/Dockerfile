FROM php:8.4-apache-bookworm

ARG APP_UID=1000
ARG APP_GID=1000

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
    APACHE_RUN_GROUP=app \
    APACHE_RUN_USER=app \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/tmp/composer

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        libicu-dev \
        libonig-dev \
        libpq-dev \
        libxml2-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        dom \
        intl \
        mbstring \
        opcache \
        pcntl \
        pdo_pgsql \
        zip \
    && a2enmod rewrite \
    && groupadd --gid "${APP_GID}" app \
    && useradd --uid "${APP_UID}" --gid app --create-home app \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY .docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php.ini /usr/local/etc/php/conf.d/tibaleine.ini
COPY --chmod=0755 .docker/init-project.sh /usr/local/bin/init-project
COPY --chmod=0755 .docker/run-worker.sh /usr/local/bin/run-tibaleine-worker

# Docker exécute Linux, même lorsque l'image est construite depuis Windows.
# Cette normalisation protège aussi les scripts provenant d'un clone en CRLF.
RUN sed -i 's/\r$//' \
        /usr/local/bin/init-project \
        /usr/local/bin/run-tibaleine-worker \
    && chmod 0755 \
        /usr/local/bin/init-project \
        /usr/local/bin/run-tibaleine-worker

WORKDIR /var/www/html

EXPOSE 80
