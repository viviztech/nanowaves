#!/bin/bash

# NanoWaves Deployment Script
# This script automates the deployment process for production

set -e  # Exit on error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration
APP_DIR="${APP_DIR:-/var/www/nanowaves}"
PHP_ARTISAN="php artisan"

echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}NanoWaves Deployment Script${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""

# Check if running as root or with sudo
if [ "$EUID" -eq 0 ]; then 
   echo -e "${RED}Error: Do not run this script as root. Use a regular user with sudo privileges.${NC}"
   exit 1
fi

# Navigate to application directory
if [ ! -d "$APP_DIR" ]; then
    echo -e "${RED}Error: Application directory not found: $APP_DIR${NC}"
    exit 1
fi

cd "$APP_DIR"

echo -e "${YELLOW}Step 1: Installing PHP dependencies...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

echo -e "${YELLOW}Step 2: Installing Node dependencies...${NC}"
npm ci --production=false

echo -e "${YELLOW}Step 3: Building frontend assets...${NC}"
npm run build

echo -e "${YELLOW}Step 4: Running database migrations...${NC}"
$PHP_ARTISAN migrate --force

echo -e "${YELLOW}Step 5: Clearing caches...${NC}"
$PHP_ARTISAN config:clear
$PHP_ARTISAN route:clear
$PHP_ARTISAN view:clear

echo -e "${YELLOW}Step 6: Caching configuration...${NC}"
$PHP_ARTISAN config:cache
$PHP_ARTISAN route:cache
$PHP_ARTISAN view:cache

echo -e "${YELLOW}Step 7: Setting permissions...${NC}"
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

echo -e "${YELLOW}Step 8: Restarting queue workers (if supervisor is configured)...${NC}"
if command -v supervisorctl &> /dev/null; then
    sudo supervisorctl restart nanowaves-worker:* 2>/dev/null || echo "Queue workers not configured or not running"
fi

echo ""
echo -e "${GREEN}========================================${NC}"
echo -e "${GREEN}Deployment completed successfully!${NC}"
echo -e "${GREEN}========================================${NC}"
echo ""
echo "Next steps:"
echo "1. Verify the application is working: https://your-domain.com"
echo "2. Check logs: tail -f storage/logs/laravel.log"
echo "3. Monitor queue workers if configured"
echo ""

