# Cerita Angka - Website Visualisasi Data BPS Kabupaten Bangkalan

Website visualisasi data interaktif yang mengubah data statistik BPS menjadi narasi visual yang menarik dan mudah dipahami.

## 🎯 Fitur Utama

### Frontend (User)
- **Visualisasi Interaktif**: Chart, Peta, Scrollytelling, Infografis
- **Cerita Data**: Narasi visual dengan berbagai tipe visualisasi
- **Dataset Terbuka**: Akses dan download dataset BPS
- **Responsive Design**: Optimal di desktop, tablet, dan mobile
- **Animasi Modern**: AOS (Animate On Scroll)

### Backend (Admin Panel)
- **Dashboard**: Statistik dan monitoring
- **CRUD Cerita**: Kelola cerita data dengan visualisasi
- **CRUD Dataset**: Upload dan kelola dataset (CSV, XLSX, XLS, JSON)
- **CRUD Halaman**: Kelola halaman statis website
- **Authentication**: Sistem login admin yang aman

## 🛠️ Teknologi

- **Framework**: Laravel 10+
- **Frontend**: Tailwind CSS, Alpine.js
- **Visualisasi**: Chart.js, Leaflet.js
- **Database**: MySQL
- **PHP**: 8.1+

## 📋 Persyaratan

- PHP >= 8.1
- Composer
- MySQL >= 5.7 / MariaDB >= 10.3
- Node.js & NPM (opsional, untuk development)

## 🚀 Instalasi

### 1. Clone atau Extract Project

```bash
cd /var/www/html
# atau di Windows: C:\xampp\htdocs
```

### 2. Install Dependencies

```bash
cd cerita-angka-bps
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
# Edit file .env
```

Ubah konfigurasi database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cerita_angka_bps
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

Buat database baru di MySQL:

```sql
CREATE DATABASE cerita_angka_bps CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Jalankan Migration

```bash
php artisan migrate
```

### 7. Buat Storage Link

```bash
php artisan storage:link
```

### 8. Buat Admin User (Seeder)

Buat file database seeder:

```bash
php artisan make:seeder AdminSeeder
```

Edit `database/seeders/AdminSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin BPS',
            'email' => 'admin@bps.go.id',
            'password' => Hash::make('password123'),
            'role' => 'superadmin'
        ]);
    }
}
```

Jalankan seeder:

```bash
php artisan db:seed --class=AdminSeeder
```

### 9. Set Permission (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 10. Jalankan Server

```bash
php artisan serve
```

Website akan berjalan di: `http://localhost:8000`

## 🔐 Login Admin

- URL: `http://localhost:8000/admin/login`
- Email: `admin@bps.go.id`
- Password: `password123`

**⚠️ PENTING: Ganti password default setelah login pertama!**

## 📁 Struktur Direktori

```
cerita-angka-bps/
├── app/
│   ├── Http/Controllers/
│   │   ├── FrontendController.php
│   │   ├── AuthController.php
│   │   └── Admin/
│   │       ├── AdminController.php
│   │       ├── PageController.php
│   │       ├── DatasetController.php
│   │       └── StoryController.php
│   └── Models/
│       ├── User.php
│       ├── Page.php
│       ├── Dataset.php
│       └── Story.php
├── database/migrations/
├── resources/views/
│   ├── layouts/
│   ├── frontend/
│   └── admin/
├── routes/web.php
└── public/
    └── uploads/
```

## 💾 Upload Dataset

Admin dapat upload dataset dalam format:
- **CSV** (Comma-separated values)
- **XLSX** (Excel 2007+)
- **XLS** (Excel 97-2003)
- **JSON**

Maksimal ukuran file: **10MB**

## 🎨 Kustomisasi Warna BPS

Warna default menggunakan palet BPS (biru #0066CC). Untuk mengubah:

Edit di `resources/views/layouts/frontend.blade.php`:

```css
:root {
    --bps-blue: #0066CC;
    --bps-light-blue: #E6F2FF;
    --bps-dark: #1a202c;
}
```

## 📊 Membuat Visualisasi Chart

Format JSON untuk Chart Config:

```json
{
    "type": "bar",
    "data": {
        "labels": ["Jan", "Feb", "Mar", "Apr"],
        "datasets": [{
            "label": "Inflasi",
            "data": [2.5, 2.7, 2.6, 2.8],
            "backgroundColor": "rgba(0, 102, 204, 0.5)"
        }]
    },
    "options": {
        "scales": {
            "y": {
                "beginAtZero": true
            }
        }
    }
}
```

Tipe chart yang didukung:
- `bar` - Diagram Batang
- `line` - Diagram Garis
- `pie` - Diagram Lingkaran
- `doughnut` - Diagram Donat
- `radar` - Diagram Radar

## 🗺️ Peta Interaktif

Visualisasi peta menggunakan Leaflet.js dengan OpenStreetMap.

Koordinat Bangkalan: `-7.0470, 112.7533`

## 🔧 Troubleshooting

### Error: "Class 'Str' not found"
```bash
composer require illuminate/support
```

### Error: "Permission denied" di storage/
```bash
chmod -R 775 storage bootstrap/cache
```

### Error: Upload file gagal
Cek `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

### Error: 404 Not Found
Pastikan `.htaccess` ada di folder `public/`

## 🌐 Deploy ke Production

### 1. Ubah Environment

```env
APP_ENV=production
APP_DEBUG=false
```

### 2. Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Set Web Server

**Apache**: Point document root ke `public/`

**Nginx**: Konfigurasi:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/cerita-angka-bps/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

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

## 📝 Lisensi

Developed for BPS Kabupaten Bangkalan

## 👨‍💻 Support

Untuk pertanyaan dan support:
- Email: bps3526@bps.go.id
- Website: https://bangkalankab.bps.go.id

## 📚 Dokumentasi Tambahan

- [Laravel Documentation](https://laravel.com/docs)
- [Chart.js Documentation](https://www.chartjs.org/docs/)
- [Leaflet Documentation](https://leafletjs.com/)
- [Tailwind CSS](https://tailwindcss.com/docs)

---

**Dibuat dengan ❤️ untuk BPS Kabupaten Bangkalan**
