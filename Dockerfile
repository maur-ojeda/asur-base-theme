FROM wordpress:6.5

# Instalar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug