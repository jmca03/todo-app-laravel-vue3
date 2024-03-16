FROM php:8.3-fpm-alpine

ARG UID
ARG GID
ARG CONTAINER_USER
ARG CONTAINER_GROUP

ENV CONTAINER_USER=${CONTAINER_USER}

WORKDIR /var/www/src

RUN apk update

RUN apk add vim openrc supervisor

RUN apk add pcre-dev ${PHPIZE_DEPS}      \
    && pecl install redis         \
    && docker-php-ext-enable redis \
    && apk del pcre-dev ${PHPIZE_DEPS}

RUN addgroup -g ${GID} ${CONTAINER_GROUP}
RUN adduser --uid ${UID} --disabled-password --ingroup ${CONTAINER_GROUP} ${CONTAINER_USER}

COPY ./src .

RUN chmod -R 775 /var/www/src/storage
RUN chmod -R 775 /var/www/src/bootstrap/cache

COPY ../config/dev/supervisord.conf /etc/supervisor/supervisord.conf

RUN mkdir /var/log/supervisor

RUN rc-update add supervisord default

COPY ../config/dev/supervisord.sh /var/www/build.sh
RUN chmod +x /var/www/build.sh

CMD [ "/bin/sh", "-c", "/var/www/build.sh" ]