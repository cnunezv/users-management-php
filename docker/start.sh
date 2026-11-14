#!/bin/sh
# Arranque del contenedor.
# Servicios como Render asignan el puerto en la variable PORT; si existe,
# Apache escucha en ese puerto. En local se usa el 80.
set -e

PORT="${PORT:-80}"

sed -ri "s/^Listen [0-9]+/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Migración de la base de datos. Solo se ejecuta si hay una base configurada
# y nunca impide que la aplicación arranque: si falla, queda en el log.
if [ -n "${DB_HOST:-}${MYSQL_ADDON_HOST:-}" ]; then
    php /var/www/html/database/migrate.php || echo "[start] La migración falló; revisa las variables de la base de datos."
fi

exec apache2-foreground
