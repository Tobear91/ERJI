# Utiliser une image PHP officielle avec Apache et extensions utiles
FROM php:8.4.5-apache

# Configuration de PHP pour le développement
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Activer le mod_rewrite et actions pour Slim (nécessaire pour routing)
RUN a2enmod rewrite actions

# Optimisation: installer les dépendances en une seule couche
RUN apt-get update && apt-get install -y default-mysql-client --no-install-recommends \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql mbstring zip xml \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configuration Apache personnalisée pour Slim
COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Optimisation: copier d'abord les fichiers de dépendances
WORKDIR /var/www/html
COPY composer.json composer.lock ./

# Optimisation: installer les dépendances avant de copier le reste du code
# Cela permet de réutiliser le cache Docker si seul le code source change
RUN composer install --no-scripts --no-autoloader --no-interaction

# Copier le reste des fichiers de l'application
COPY . .

# Finaliser l'installation de Composer
RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data /var/www/html

# Configurer les variables d'environnement PHP pour la production
ENV PHP_OPCACHE_ENABLE=1 \
    PHP_OPCACHE_ENABLE_CLI=1 \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0 \
    PHP_OPCACHE_REVALIDATE_FREQ=0

# Activer opcache pour de meilleures performances
RUN docker-php-ext-enable opcache

EXPOSE 80

# Utiliser un script d'entrée pour démarrer Apache
CMD ["apache2-foreground"]