#!/bin/sh

set -e

php artisan storage:link
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan vendor:publish --provider="JackWH\LaravelNewRelic\LaravelNewRelicServiceProvider"

if [ "${CONTAINER_TYPE}" = "app" ]; then
    nginx
    /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord/laravel-octane-worker.conf
elif [ "${CONTAINER_TYPE}" = "worker" ]; then
    /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord/laravel-horizon-worker.conf
elif [ "${CONTAINER_TYPE}" = "schedule" ]; then
    echo "Executando scheduler..."
    while [ true ]
    do
      php artisan schedule:run --verbose --no-interaction &
      sleep 60
    done
else
    echo "O tipo do contêiner não foi especificado"
    exit 1
fi
