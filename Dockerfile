FROM wordpress:6.5

# Instalar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Instalar WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp
