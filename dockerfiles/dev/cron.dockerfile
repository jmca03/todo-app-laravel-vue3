FROM php:8.3-fpm-alpine

ARG UID
ARG GID
ARG CONTAINER_USER
ARG CONTAINER_GROUP
ARG CONTAINER_PASSWORD

WORKDIR /var/www/src

RUN apk update

RUN apk add vim openrc dcron openssh-server

RUN apk add pcre-dev ${PHPIZE_DEPS}      \
    && pecl install redis         \
    && docker-php-ext-enable redis \
    && apk del pcre-dev ${PHPIZE_DEPS}

RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config

RUN addgroup -g ${GID} ${CONTAINER_GROUP}

RUN adduser -D --uid ${UID} \ 
    --ingroup ${CONTAINER_GROUP} \ 
    --shell /bin/sh ${CONTAINER_USER} \
    --home /home/${CONTAINER_USER}

RUN echo "${CONTAINER_USER}:${CONTAINER_PASSWORD}" | chpasswd

COPY ./src .

RUN chmod -R 775 /var/www/src/storage
RUN chmod -R 775 /var/www/src/bootstrap/cache

COPY ../config/dev/cron /etc/cron.d/root

RUN rc-update add dcron default

COPY ../config/dev/cron.sh /var/www/build.sh
RUN chmod +x /var/www/build.sh

RUN mkdir /var/run/sshd

RUN mkdir -p /var/log
RUN mkdir -p /var/log/cron

RUN touch /var/log/cron/cron.log

CMD [ "/bin/sh", "-c", "/var/www/build.sh" ]