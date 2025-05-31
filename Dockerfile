# ベースイメージ
FROM php:8.2-fpm

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ設定
WORKDIR /var/www/html

# アプリケーションファイルをコピー
COPY . .

# Composerで依存関係をインストール
RUN composer install --no-dev --optimize-autoloader

# パーミッション設定（必要に応じて）
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8000ポートを開放
EXPOSE 8000

# Laravelのビルトインサーバ起動
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
