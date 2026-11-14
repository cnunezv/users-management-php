#!/bin/sh
# Arranque del contenedor.
# Servicios como Render asignan el puerto en la variable PORT; si existe,
# Apache escucha en ese puerto. En local se usa el 80.
set -e

PORT="${PORT:-80}"

sed -ri "s/^Listen [0-9]+/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

exec apache2-foreground
