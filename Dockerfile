FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

WORKDIR /var/www/html

<<<<<<< HEAD
COPY ./app/ /var/www/html/
=======
COPY ./www/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html
>>>>>>> a738987 (24/08 - front,back e um pouco do bd)
