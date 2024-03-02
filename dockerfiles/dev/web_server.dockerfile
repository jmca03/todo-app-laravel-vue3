# syntax=docker/dockerfile:1
FROM nginx:alpine:3.18

ARG UID
ARG GID

RUN apk -y update

# Install vim for easier editing
# of files
RUN apk add vim

COPY ../../config/dev/nginx.conf /etc/nginx.conf.d/default.conf

# Create docker group with group id matching with host pc
RUN groupadd docker --gid ${GID}
# Create user docker with user id matching with host pc
RUN useradd docker --uid ${UID} -g docker
# Add docker to docker group
# RUN usermod -a -G docker docker 

EXPOSE 81
EXPOSE 8443