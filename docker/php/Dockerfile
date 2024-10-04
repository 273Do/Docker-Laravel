FROM php:8.2-fpm

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --from=node:20.16 /usr/local/bin /usr/local/bin
COPY --from=node:20.16 /usr/local/lib /usr/local/lib

RUN apt-get update \
    && apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

ARG GITHUB_USER_NAME
ARG GITHUB_MAIL

RUN git config --global user.name "${GITHUB_USER_NAME}" \
    && git config --global user.email "${GITHUB_MAIL}" \
    && git config --global --add safe.directory /var/www/html 

WORKDIR /var/www/html