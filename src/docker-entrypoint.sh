#!/bin/sh

# Ensure writable directories
chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs || true

exec "${@:-/usr/sbin/apache2ctl -D FOREGROUND}"
