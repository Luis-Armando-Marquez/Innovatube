FROM php:8.2-apache

# Instala mysqli y extensiones necesarias
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copia tu código al directorio público de Apache
COPY . /var/www/html/

# Da permisos a los archivos (opcional pero recomendable)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
