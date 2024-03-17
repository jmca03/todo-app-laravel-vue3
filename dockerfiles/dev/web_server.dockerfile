# syntax=docker/dockerfile:1
FROM nginx:stable-alpine3.17-slim

ARG UID
ARG GID
ARG CONTAINER_USER
ARG CONTAINER_GROUP

WORKDIR /var/www

RUN apk update

# Install vim for easier editing
# of files
RUN apk add vim openssl

COPY ../../config/dev/nginx.conf /etc/nginx/conf.d/default.conf

RUN addgroup -g ${GID} ${CONTAINER_GROUP}
RUN adduser --uid ${UID} --disabled-password --ingroup ${CONTAINER_GROUP} ${CONTAINER_USER}

COPY ../config/dev/nginx.sh /var/www/build.sh

RUN chmod +x /var/www/build.sh

EXPOSE 80
EXPOSE 443

CMD [ "/bin/sh", "-c", "/var/www/build.sh" ]