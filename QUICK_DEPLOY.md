# Quick Deployment Reference

Quick commands for deploying NanoWaves application.

## First Time Deployment

```bash
# Clone repository
git clone <repo-url> /var/www/nanowaves
cd /var/www/nanowaves

# Setup environment
cp .env.example .env
nano .env  # Configure all variables

# Install dependencies and build
composer install --no-dev --optimize-autoloader
npm ci --production=false
npm run build

# Setup database
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=PlanSeeder
php artisan db:seed --class=AdminUserSeeder

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## Using Composer Scripts

```bash
# Full deployment (first time)
composer run deploy

# Update deployment (after code changes)
composer run deploy:update
```

## Using Deployment Script

```bash
# Make script executable (first time only)
chmod +x deploy.sh

# Run deployment
./deploy.sh

# Or with custom app directory
APP_DIR=/var/www/nanowaves ./deploy.sh
```

## Quick Update (After Git Pull)

```bash
cd /var/www/nanowaves
git pull origin main
composer install --no-dev --optimize-autoloader
npm ci --production=false
npm run build
php artisan migrate --force
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo supervisorctl restart nanowaves-worker:*  # if using supervisor
```

## Environment Variables Checklist

Ensure these are set in `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=nanowaves
DB_USERNAME=your_user
DB_PASSWORD=your_password

RAZORPAY_KEY_ID=your_key
RAZORPAY_KEY_SECRET=your_secret

MSG91_AUTH_KEY=your_key
MSG91_SENDER_ID=NANOWS

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@your-domain.com
```

## Common Commands

```bash
# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:cache

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check queue workers
sudo supervisorctl status nanowaves-worker:*

# View logs
tail -f storage/logs/laravel.log

# Run migrations
php artisan migrate --force

# Build assets
npm run build
```

## Troubleshooting

### 500 Error
```bash
php artisan config:clear
chmod -R 775 storage bootstrap/cache
```

### Assets Not Loading
```bash
npm run build
```

### Queue Not Working
```bash
sudo supervisorctl restart nanowaves-worker:*
```

### Database Issues
```bash
php artisan migrate:status
php artisan migrate --force
```

