# ============================================================
# Imagen de la aplicación: PHP 8.3 + Apache (mod_rewrite) + PDO MySQL
# ============================================================
FROM php:8.3-apache

# Extensiones que usa la aplicación (PDO MySQL) y mod_rewrite para el .htaccess
RUN docker-php-ext-install pdo_mysql \
    && a2enmod rewrite

# Permitir que el .htaccess de la raíz del proyecto aplique sus reglas
RUN sed -ri 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

COPY docker/start.sh /usr/local/bin/start-app
RUN chmod +x /usr/local/bin/start-app

EXPOSE 80

CMD ["start-app"]
