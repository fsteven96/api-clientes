#!/bin/bash
set -e

# Ir al directorio de la app
cd /home/site/wwwroot

# Mostrar ruta actual por depuración
echo "Directorio actual: $(pwd)"

# Copiar .env si no existe
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Instalar dependencias
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Asignar permisos
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Generar APP_KEY si no existe
if ! grep -q "APP_KEY=base64" .env; then
    php artisan key:generate
fi

# Iniciar el servidor de Laravel (usando el puerto que asigna Azure)
php artisan serve --host=0.0.0.0 --port=${PORT}
