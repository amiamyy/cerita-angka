# Panduan Deployment ke Production

## Persiapan Server

### Requirements
- Ubuntu 20.04+ / CentOS 8+
- PHP 8.1+
- MySQL 8.0+ / MariaDB 10.3+
- Nginx / Apache
- Composer
- Git (opsional)

### 1. Install PHP dan Extensions

```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip php8.1-gd

# CentOS/RHEL
sudo dnf install php php-fpm php-mysqlnd php-mbstring php-xml php-curl php-zip php-gd
```

### 2. Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 3. Install MySQL

```bash
# Ubuntu/Debian
sudo apt install mysql-server

# CentOS/RHEL
sudo dnf install mysql-server
sudo systemctl start mysqld
sudo systemctl enable mysqld
```

## Deploy Aplikasi

### 1. Upload Files

Upload semua file ke server (via FTP, Git, atau SCP):

```bash
# Via Git (jika menggunakan repository)
cd /var/www
git clone https://your-repo-url.git cerita-angka-bps

# Via SCP
scp -r /local/path/cerita-angka-bps user@server:/var/www/
```

### 2. Set Permissions

```bash
cd /var/www/cerita-angka-bps
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 775 storage bootstrap/cache
```

### 3. Install Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

### 4. Setup Environment

```bash
cp .env.example .env
nano .env
```

Update konfigurasi production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=cerita_angka_bps
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password
```

### 5. Generate Key & Setup Database

```bash
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=AdminSeeder
php artisan storage:link
```

### 6. Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer dump-autoload --optimize
```

## Web Server Configuration

### Nginx

Create file: `/etc/nginx/sites-available/cerita-angka`

```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/cerita-angka-bps/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/cerita-angka /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### Apache

Create file: `/etc/apache2/sites-available/cerita-angka.conf`

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    DocumentRoot /var/www/cerita-angka-bps/public

    <Directory /var/www/cerita-angka-bps/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/cerita-angka-error.log
    CustomLog ${APACHE_LOG_DIR}/cerita-angka-access.log combined
</VirtualHost>
```

Enable site:

```bash
sudo a2ensite cerita-angka
sudo a2enmod rewrite
sudo systemctl restart apache2
```

## SSL/HTTPS dengan Let's Encrypt

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx  # untuk Nginx
# atau
sudo apt install certbot python3-certbot-apache  # untuk Apache

# Generate certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com  # Nginx
# atau
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com  # Apache

# Auto-renewal
sudo certbot renew --dry-run
```

## Maintenance & Updates

### Update Aplikasi

```bash
cd /var/www/cerita-angka-bps
git pull  # jika menggunakan git
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Backup Database

```bash
# Manual backup
mysqldump -u username -p cerita_angka_bps > backup_$(date +%Y%m%d).sql

# Automated backup (crontab)
# Edit: crontab -e
0 2 * * * mysqldump -u username -p'password' cerita_angka_bps > /backups/db_$(date +\%Y\%m\%d).sql
```

### Monitoring

```bash
# Check logs
tail -f storage/logs/laravel.log

# Check Nginx/Apache logs
tail -f /var/log/nginx/error.log
tail -f /var/log/apache2/error.log
```

## Security Checklist

- [ ] Ganti password admin default
- [ ] Set `APP_DEBUG=false` di production
- [ ] Gunakan HTTPS (SSL/TLS)
- [ ] Set permission yang benar (755 untuk folder, 644 untuk file)
- [ ] Backup database secara regular
- [ ] Update dependencies secara berkala
- [ ] Monitor error logs
- [ ] Setup firewall (UFW/Firewalld)
- [ ] Disable directory listing
- [ ] Hide server information

## Troubleshooting Production

### 500 Internal Server Error
- Check file permissions
- Check storage/logs/laravel.log
- Check web server error logs
- Run: `php artisan config:clear`

### Database Connection Error
- Verify database credentials in .env
- Check MySQL is running: `systemctl status mysql`
- Test connection: `mysql -u username -p`

### File Upload Issues
- Check upload_max_filesize in php.ini
- Check post_max_size in php.ini
- Verify storage directory permissions

### Performance Issues
- Enable OPcache in php.ini
- Use Redis/Memcached for cache
- Optimize database queries
- Enable CDN for static assets

## Support

Untuk bantuan lebih lanjut:
- Email: bps3526@bps.go.id
- Dokumentasi Laravel: https://laravel.com/docs

---

**Best Practices**: Selalu test di staging environment sebelum deploy ke production!
