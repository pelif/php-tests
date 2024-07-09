FROM php:8.3-fpm

COPY . /var/www/html    
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    zip \
    vim \
    && docker-php-ext-install zip pdo pdo_mysql \
    && apt-get clean	

RUN useradd -m composeruser	

RUN chown -R composeruser:composeruser /usr/local/bin
RUN chown -R composeruser:composeruser /var/www/html

USER composeruser

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN composer require phpunit/phpunit:^10.5 --no-interaction --no-plugins --no-scripts
RUN composer require guzzlehttp/guzzle:^7.0 --no-interaction --no-plugins --no-scripts

RUN composer update --lock --no-interaction --no-plugins --no-scripts