# Imagen base oficial de PHP con extensiones
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
build-essential \
libpng-dev \
libjpeg-dev \
libfreetype6-dev \
libonig-dev \
libxml2-dev \
zip \
curl \
unzip \
git \
nano \
libzip-dev \
&& docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear carpeta del proyecto
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear el archivo de configuración de la clave (si no existe)
RUN php artisan config:clear && php artisan route:clear

# Exponer puerto
EXPOSE 8080

# Comando para iniciar Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
