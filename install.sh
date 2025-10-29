#!/bin/bash

echo "================================================"
echo "Cerita Angka - BPS Bangkalan Installation"
echo "================================================"
echo ""

# Check PHP
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.1 or higher."
    exit 1
fi

echo "✓ PHP found: $(php -v | head -n 1)"

# Check Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first."
    echo "   Visit: https://getcomposer.org/"
    exit 1
fi

echo "✓ Composer found"

# Install dependencies
echo ""
echo "📦 Installing dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy .env if not exists
if [ ! -f .env ]; then
    echo ""
    echo "📝 Creating .env file..."
    cp .env.example .env
fi

# Generate key
echo ""
echo "🔑 Generating application key..."
php artisan key:generate --ansi

# Database setup prompt
echo ""
echo "================================================"
echo "Database Configuration"
echo "================================================"
read -p "Database name [cerita_angka_bps]: " DB_NAME
DB_NAME=${DB_NAME:-cerita_angka_bps}

read -p "Database username [root]: " DB_USER
DB_USER=${DB_USER:-root}

read -s -p "Database password [leave empty for no password]: " DB_PASS
echo ""

# Update .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" .env

# Create database
echo ""
read -p "Create database automatically? (y/n) [y]: " CREATE_DB
CREATE_DB=${CREATE_DB:-y}

if [ "$CREATE_DB" = "y" ]; then
    echo "Creating database..."
    mysql -u$DB_USER -p$DB_PASS -e "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    echo "✓ Database created"
fi

# Run migrations
echo ""
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Create storage link
echo ""
echo "🔗 Creating storage link..."
php artisan storage:link

# Seed admin user
echo ""
read -p "Create admin user? (y/n) [y]: " CREATE_ADMIN
CREATE_ADMIN=${CREATE_ADMIN:-y}

if [ "$CREATE_ADMIN" = "y" ]; then
    echo "Creating admin user..."
    php artisan db:seed --class=AdminSeeder
fi

# Set permissions
echo ""
echo "🔒 Setting permissions..."
chmod -R 775 storage bootstrap/cache
if [ "$EUID" -eq 0 ]; then
    chown -R www-data:www-data storage bootstrap/cache
fi

echo ""
echo "================================================"
echo "✅ Installation Complete!"
echo "================================================"
echo ""
echo "To start the development server, run:"
echo "  php artisan serve"
echo ""
echo "Then visit: http://localhost:8000"
echo "Admin panel: http://localhost:8000/admin/login"
echo ""
echo "Default admin credentials:"
echo "  Email: admin@bps.go.id"
echo "  Password: password123"
echo ""
echo "⚠️  IMPORTANT: Change the admin password after first login!"
echo "================================================"
