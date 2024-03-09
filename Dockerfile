# syntax=docker/dockerfile:1

# Composer
FROM composer:lts as composer

FROM php:8.3-fpm-alpine as server_side

ARG UID
ARG GID
ARG CONTAINER_USER
ARG CONTAINER_GROUP

WORKDIR /var/www/html

COPY ./src .
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/cache

EXPOSE 9000

FROM nginx:mainline-alpine3.18 as web_server

COPY ../../config/dev/nginx.conf /etc/nginx.conf.d/default.conf

EXPOSE 81
EXPOSE 8443

FROM alpine as base

RUN apk update
RUN apk add vim

RUN addgroup -g ${GID} ${CONTAINER_GROUP}
RUN adduser --uid ${UID} --disabled-password --ingroup ${CONTAINER_GROUP} ${CONTAINER_USER}

RUN docker-php-ext-install mysqli pdo pdo_mysql
# RUN docker-php-ext-install pdo_pgsql
# RUN docker-php-ext-install pdo_sqlsrv

RUN apk add pcre-dev ${PHPIZE_DEPS}      \
    && pecl install mongodb redis         \
    && docker-php-ext-enable mongodb redis \
    && apk del pcre-dev ${PHPIZE_DEPS}

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --from=server_side /usr/local/bin/php /usr/local/bin/php
COPY --from=server_side /var/www/html/server_side /var/www/api

COPY --from=web_server /usr/sbin/nginx /usr/sbin/nginx
COPY --from=web_server /etc/nginx.conf.d/default.conf /etc/nginx.conf.d/default.conf

USER ${CONTAINER_USER}
