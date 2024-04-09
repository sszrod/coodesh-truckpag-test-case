FROM phpswoole/swoole:5.0.1-php8.2

ARG NEW_RELIC_AGENT_URL="$(new-relic-agent-url)"
ARG NEW_RELIC_LICENSE_KEY="$(new-relic-license-key)"
ARG NEW_RELIC_APP_NAME="$(new-relic-app-name)"

# Instalação e configuração newrelic
RUN curl -L ${NEW_RELIC_AGENT_URL} | tar -C /tmp -zx && \
    export NR_INSTALL_USE_CP_NOT_LN=1 && \
    export NR_INSTALL_SILENT=1 && \
    /tmp/newrelic-php5-*/newrelic-install install && \
    rm -rf /tmp/newrelic-php5-* /tmp/nrinstall* && \
    sed -i \
        -e "s/newrelic.license =.*/newrelic.license = ${NEW_RELIC_LICENSE_KEY}/" \
        -e "s/newrelic.appname =.*/newrelic.appname = ${NEW_RELIC_APP_NAME}/" \
        /usr/local/etc/php/conf.d/newrelic.ini

# Instalar dependências do Ubuntu Linux
RUN apt update && \
    apt install -y nginx libzip-dev $PHPIZE_DEPS

# Instalar extensões do PHP
RUN docker-php-ext-install opcache pcntl zip
RUN pecl update-channels && \
    pecl install ds igbinary && \
    docker-php-ext-enable ds igbinary
RUN pecl install -D 'enable-redis-igbinary="yes"' redis && \
    docker-php-ext-enable redis && \
    pecl install mongodb && docker-php-ext-enable mongodb
RUN apt install -y \
        libxslt-dev \
        libgcrypt-dev
RUN docker-php-ext-install xsl bcmath intl

# Copiar configurações
COPY .docker/production/nginx/default.conf /etc/nginx/sites-available/default
COPY .docker/production/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY .docker/production/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY .docker/production/supervisord/laravel-horizon-worker.conf /etc/supervisor/conf.d/supervisord/laravel-horizon-worker.conf
COPY .docker/production/supervisord/laravel-octane-worker.conf /etc/supervisor/conf.d/supervisord/laravel-octane-worker.conf

# Instalar Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Copiar projeto
COPY --chown=www-data:www-data . /app

WORKDIR /app

# Instalar dependências do projeto
RUN composer install --optimize-autoloader --no-dev

# Determinar entrypoint
COPY .docker/production/entrypoint.sh /entrypoint.sh
ENTRYPOINT sh /entrypoint.sh

EXPOSE 80
