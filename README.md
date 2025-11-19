# NanoWaves

A Laravel-based subscription management platform with payment gateway integration and SMS OTP verification.

## Features

- ✅ Admin panel for managing users, plans, and subscriptions
- ✅ Customer portal for viewing plans and managing subscriptions
- ✅ Razorpay payment gateway integration
- ✅ MSG91 SMS gateway for OTP verification
- ✅ Role-based permission system
- ✅ Subscription management
- ✅ Plan management

## Requirements

- PHP 8.2 or 8.3
- Composer
- Node.js 18+ and npm
- MySQL/PostgreSQL (or SQLite for development)
- Web server (Nginx/Apache)

## Installation

### Development Setup

```bash
# Clone repository
git clone <repository-url> nanowaves
cd nanowaves

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env file
# Then run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Build assets
npm run build

# Start development server
composer run dev
```

## Configuration

### Environment Variables

Copy `.env.example` to `.env` and configure:

- **Database**: `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- **Razorpay**: `RAZORPAY_KEY_ID`, `RAZORPAY_KEY_SECRET`
- **MSG91**: `MSG91_AUTH_KEY`, `MSG91_SENDER_ID`, `MSG91_ROUTE`
- **Mail**: `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`

See `.env.example` for all available configuration options.

### Setup Guides

- [Admin Panel Setup](ADMIN_PANEL_SETUP.md)
- [Razorpay Setup](RAZORPAY_SETUP.md)
- [MSG91 Setup](MSG91_SETUP.md)
- [Role & Permission System](ROLE_PERMISSION_SYSTEM.md)
- [Customer Portal Credentials](CUSTOMER_PORTAL_CREDENTIALS.md)

## Deployment

### Quick Deployment

```bash
# Using Composer script
composer run deploy

# Or using deployment script
./deploy.sh
```

### Full Deployment Guide

See [DEPLOYMENT.md](DEPLOYMENT.md) for complete deployment instructions.

### Quick Reference

See [QUICK_DEPLOY.md](QUICK_DEPLOY.md) for quick deployment commands.

### Deployment Checklist

See [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md) for a comprehensive checklist.

## Available Scripts

- `composer run setup` - Initial setup (install dependencies, generate key, migrate, build)
- `composer run dev` - Start development server with hot reload
- `composer run deploy` - Production deployment
- `composer run deploy:update` - Update existing deployment
- `composer run test` - Run tests
- `npm run build` - Build production assets
- `npm run dev` - Start Vite dev server

## Project Structure

```
nanowaves/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Services/           # Service classes (Msg91Service)
│   └── Traits/             # Reusable traits
├── config/                 # Configuration files
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── public/                 # Public web root
├── resources/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   └── views/             # Blade templates
├── routes/                 # Route definitions
└── storage/                # Storage directory
```

## Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Razorpay Documentation](https://razorpay.com/docs)
- [MSG91 Documentation](https://docs.msg91.com)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
