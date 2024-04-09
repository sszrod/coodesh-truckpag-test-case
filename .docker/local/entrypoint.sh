#!/bin/sh

# Configurar permissões
chmod 777 -R .docker/local/
chmod 777 -R storage/
chmod 777 -R bootstrap/cache/

# Instalação das dependências
composer install
composer dump-autoload --optimize
composer clear-cache
npm install

# Comandos artisan
php artisan optimize:clear
find public -type l -delete # caso haja algum symlink será removido
php artisan storage:link # refazendo o symlink
php artisan db:seed # populando os dados faker

nginx
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf


