#!/bin/bash

cd /home/site/wwwroot

# 1. Instala dependencias de Composer
composer install --no-interaction --prefer-dist --optimize-autoloader

# 2. Permisos para almacenamiento
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 3. Generar clave si no existe
if [ ! -f storage/oauth-private.key ]; then
    php artisan key:generate
fi

# 4. Servir Laravel
php -S 0.0.0.0:$PORT -t public
