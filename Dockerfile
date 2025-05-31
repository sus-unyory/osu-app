FROM php:8.2-fpm

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www/html

# アプリケーションファイルをコピー
COPY . .

# Laravel 依存インストール
RUN composer install --no-dev --optimize-autoloader

# Laravelのstorage権限
RUN mkdir -p bootstrap/cache storage/logs \
    && chown -R www-data:www-data bootstrap storage \
    && chmod -R 775 bootstrap storage

# ポートを開ける
EXPOSE 8000

# Laravelサーバ起動
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT}"]
