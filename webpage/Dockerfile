FROM php:7.4-apache

# Installa estensione pgsql per PostgreSQL
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pgsql