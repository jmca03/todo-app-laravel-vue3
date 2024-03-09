FROM php:8.3-fpm-alpine

ARG UID
ARG GID
ARG CONTAINER_USER
ARG CONTAINER_GROUP

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

# RUN groupmod -g ${UID} www-data

COPY ./src .
RUN chmod -R 775 /var/www/src/storage
RUN chmod -R 775 /var/www/src/bootstrap/cache

USER ${CONTAINER_USER}

EXPOSE 9000