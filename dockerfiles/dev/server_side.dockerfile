# syntax=docker/dockerfile:1
FROM composer:lts as composer

FROM php:8.3-fpm-alpine

ARG UID
ARG GID
ARG DATABASE_NAME
ARG DATABASE_USER
ARG CONTAINER_USER
ARG CONTAINER_GROUP
ARG DATABASE_PASSWORD

ENV DATABASE_NAME=${DATABASE_NAME}
ENV DATABASE_USER=${DATABASE_USER}
ENV DATABASE_PASSWORD=${DATABASE_PASSWORD}

WORKDIR /var/www/src

RUN apk update

RUN apk add vim

RUN apk add zip unzip

RUN docker-php-ext-install mysqli pdo pdo_mysql
# RUN docker-php-ext-install pdo_pgsql
# RUN docker-php-ext-install pdo_sqlsrv

RUN apk add pcre-dev ${PHPIZE_DEPS}      \
    && pecl install mongodb redis         \
    && docker-php-ext-enable mongodb redis \
    && apk del pcre-dev ${PHPIZE_DEPS}

RUN addgroup -g ${GID} ${CONTAINER_GROUP}
RUN adduser --uid ${UID} --disabled-password --ingroup ${CONTAINER_GROUP} ${CONTAINER_USER}
RUN adduser ${CONTAINER_USER} www-data

# RUN groupmod -g ${UID} www-data

COPY ./src .

RUN chown -R www-data:www-data /var/www/src/storage
RUN chown -R www-data:www-data /var/www/src/bootstrap/cache
RUN chmod -R 775 /var/www/src/storage
RUN chmod -R 775 /var/www/src/bootstrap/cache

COPY --from=composer /usr/bin/composer /usr/bin/composer

USER ${CONTAINER_USER}

EXPOSE 9000