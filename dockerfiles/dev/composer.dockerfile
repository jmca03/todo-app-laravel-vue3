# syntax=docker/dockerfile:1
FROM composer:lts

ARG UID
ARG GID
ARG CONTAINER_USER
ARG CONTAINER_GROUP

WORKDIR /var/www/html

# Create docker group with group id matching with host pc
RUN addgroup -g ${GID} ${CONTAINER_GROUP}
# Create user docker with user id matching with host pc
# RUN adduser --uid 1000 --disabled-password --ingroup docker docker
RUN adduser --uid ${UID} --disabled-password --ingroup ${CONTAINER_GROUP} ${CONTAINER_USER}

USER ${CONTAINER_USER}

ENTRYPOINT [ "composer" ]