# NanoWaves Deployment Guide

This guide provides step-by-step instructions for deploying the NanoWaves Laravel application to production.

## Prerequisites

- PHP 8.2 or 8.3
- Composer
- Node.js and npm
- MySQL/PostgreSQL database (or SQLite for small deployments)
- Web server (Nginx/Apache)
- SSL certificate (for HTTPS)

## Pre-Deployment Checklist

- [ ] All environment variables configured in `.env`
- [ ] Database credentials verified
- [ ] Razorpay API keys configured (for production)
- [ ] MSG91 API credentials configured (for production)
- [ ] Mail server configured
- [ ] SSL certificate installed
- [ ] Domain DNS configured

## Deployment Steps

### 1. Server Setup

#### Install PHP and Required Extensions
```bash
# Ubuntu/Debian
sudo apt-get update
sudo apt-get install php8.2-fpm php8.2-cli php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath

# CentOS/RHEL
sudo yum install php82-php-fpm php82-php-cli php82-php-mysqlnd php82-php-xml php82-php-mbstring php82-php-curl php82-php-zip php82-php-gd php82-php-bcmath
```

#### Install Composer
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### Install Node.js and npm
```bash
# Using NodeSource repository (Ubuntu/Debian)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs
```

### 2. Clone and Setup Application

```bash
# Clone repository
git clone <repository-url> /var/www/nanowaves
cd /var/www/nanowaves

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure .env file with production settings
nano .env
```

### 3. Configure Environment Variables

Edit `.env` file with production values:

```env
APP_NAME="NanoWaves"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nanowaves
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Payment Gateway
RAZORPAY_KEY_ID=your_production_key_id
RAZORPAY_KEY_SECRET=your_production_key_secret

# SMS Gateway
MSG91_AUTH_KEY=your_production_auth_key
MSG91_SENDER_ID=NANOWS
MSG91_ROUTE=4

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_smtp_username
MAIL_PASSWORD=your_smtp_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@your-domain.com"
MAIL_FROM_NAME="NanoWaves"

# Session & Cache (for production, use Redis if available)
SESSION_DRIVER=database
CACHE_STORE=database
SESSION_SECURE_COOKIE=true

# Queue
QUEUE_CONNECTION=database
```

### 4. Database Setup

```bash
# Run migrations
php artisan migrate --force

# Seed database (optional - only for initial setup)
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=PlanSeeder
php artisan db:seed --class=AdminUserSeeder
```

### 5. Build Frontend Assets

```bash
# Install Node dependencies
npm ci --production=false

# Build assets for production
npm run build
```

### 6. Set Permissions

```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/nanowaves

# Set directory permissions
sudo find /var/www/nanowaves -type d -exec chmod 755 {} \;
sudo find /var/www/nanowaves -type f -exec chmod 644 {} \;

# Set storage and cache permissions
sudo chmod -R 775 /var/www/nanowaves/storage
sudo chmod -R 775 /var/www/nanowaves/bootstrap/cache
```

### 7. Optimize Application

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Cache events (if applicable)
php artisan event:cache
```

### 8. Setup Queue Worker (Optional but Recommended)

For production, set up a queue worker to process background jobs:

```bash
# Using Supervisor
sudo nano /etc/supervisor/conf.d/nanowaves-worker.conf
```

Add the following configuration:

```ini
[program:nanowaves-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/nanowaves/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/nanowaves/storage/logs/worker.log
stopwaitsecs=3600
```

Then start supervisor:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start nanowaves-worker:*
```

### 9. Setup Scheduled Tasks (Cron)

Add Laravel's scheduler to crontab:

```bash
sudo crontab -e -u www-data
```

Add this line:

```
* * * * * cd /var/www/nanowaves && php artisan schedule:run >> /dev/null 2>&1
```

### 10. Web Server Configuration

#### Nginx Configuration

Create `/etc/nginx/sites-available/nanowaves`:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name your-domain.com www.your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name your-domain.com www.your-domain.com;
    root /var/www/nanowaves/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    ssl_certificate /path/to/your/certificate.crt;
    ssl_certificate_key /path/to/your/private.key;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable the site:

```bash
sudo ln -s /etc/nginx/sites-available/nanowaves /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### Apache Configuration

Create `/etc/apache2/sites-available/nanowaves.conf`:

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    ServerAlias www.your-domain.com
    Redirect permanent / https://your-domain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName your-domain.com
    ServerAlias www.your-domain.com
    DocumentRoot /var/www/nanowaves/public

    SSLEngine on
    SSLCertificateFile /path/to/your/certificate.crt
    SSLCertificateKeyFile /path/to/your/private.key

    <Directory /var/www/nanowaves/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/nanowaves_error.log
    CustomLog ${APACHE_LOG_DIR}/nanowaves_access.log combined
</VirtualHost>
```

Enable the site:

```bash
sudo a2ensite nanowaves.conf
sudo a2enmod rewrite ssl
sudo systemctl reload apache2
```

## Post-Deployment

### 1. Verify Deployment

- [ ] Visit `https://your-domain.com` - should load correctly
- [ ] Check admin panel: `https://your-domain.com/admin/login`
- [ ] Check customer portal: `https://your-domain.com/customer/login`
- [ ] Test payment flow (use test mode first)
- [ ] Test OTP verification (if MSG91 configured)

### 2. Monitor Logs

```bash
# Application logs
tail -f /var/www/nanowaves/storage/logs/laravel.log

# Nginx logs
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log

# Queue worker logs
tail -f /var/www/nanowaves/storage/logs/worker.log
```

### 3. Security Checklist

- [ ] `APP_DEBUG=false` in `.env`
- [ ] `APP_ENV=production` in `.env`
- [ ] SSL certificate installed and working
- [ ] `.env` file not accessible via web
- [ ] Storage directory permissions correct
- [ ] Database credentials secure
- [ ] API keys are production keys (not test keys)

## Updating the Application

For future updates:

```bash
cd /var/www/nanowaves

# Pull latest changes
git pull origin main

# Install/update dependencies
composer install --no-dev --optimize-autoloader
npm ci --production=false

# Run migrations
php artisan migrate --force

# Build assets
npm run build

# Clear and cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart queue workers
sudo supervisorctl restart nanowaves-worker:*
```

## Troubleshooting

### 500 Internal Server Error
- Check file permissions
- Check Laravel logs: `storage/logs/laravel.log`
- Verify `.env` file exists and is configured correctly
- Clear config cache: `php artisan config:clear`

### Assets Not Loading
- Run `npm run build`
- Check `public/build` directory exists
- Verify web server can access `public` directory

### Database Connection Error
- Verify database credentials in `.env`
- Check database server is running
- Verify database user has proper permissions

### Queue Jobs Not Processing
- Check supervisor status: `sudo supervisorctl status`
- Check worker logs: `storage/logs/worker.log`
- Restart workers: `sudo supervisorctl restart nanowaves-worker:*`

## Production Optimizations

1. **Use Redis for Cache/Sessions** (recommended for high traffic):
   ```env
   CACHE_STORE=redis
   SESSION_DRIVER=redis
   QUEUE_CONNECTION=redis
   ```

2. **Enable OPcache** in PHP for better performance

3. **Use CDN** for static assets

4. **Enable HTTP/2** in web server configuration

5. **Set up monitoring** (e.g., Laravel Telescope, Sentry)

6. **Regular backups** of database and files

## Support

For issues or questions, refer to:
- Laravel Documentation: https://laravel.com/docs
- Razorpay Documentation: https://razorpay.com/docs
- MSG91 Documentation: https://docs.msg91.com

