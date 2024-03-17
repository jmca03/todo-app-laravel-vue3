#! /bin/sh

su ${CONTAINER_USER}
openssl req -q -trustout -x509 -newkey rsa:4096 -sha256 -nodes -keyout /var/www/self-signed-cert/nginx-self-signed.key -out /var/www/self-signed-cert/nginx-self-signed.crt -subj "/C=PH/ST=PH/L=PH/O=HOMESTEAD/CN=localhost"

su root
mkdir -p /etc/nginx/ssl

cp /var/www/self-signed-cert/nginx-self-signed.crt /etc/nginx/ssl
cp /var/www/self-signed-cert/nginx-self-signed.key /etc/nginx/ssl

nginx -g 'daemon off;'
    