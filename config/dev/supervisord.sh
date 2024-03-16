#! /bin/sh

mkdir -p /var/log
mkdir -p /var/log/supervisord

touch /var/log/supervisor/supervisord.log
touch /var/log/supervisor/laravel-queue.log

supervisord -c /etc/supervisor/supervisord.conf