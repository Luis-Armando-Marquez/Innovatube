FROM php:8.2-apache

# Instala mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copia todos tus archivos al contenedor
COPY . /var/www/html/

# Da permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Habilita el módulo de reescritura de Apache (si lo usas)
RUN a2enmod rewrite
