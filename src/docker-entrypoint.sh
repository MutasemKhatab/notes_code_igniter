#!/bin/sh

# Ensure writable directories
mkdir -p /var/www/html/application/cache/sessions
chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs

exec "${@:-/usr/sbin/apache2ctl -D FOREGROUND}"
