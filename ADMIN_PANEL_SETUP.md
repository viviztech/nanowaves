# Admin Panel Setup Guide

This document provides instructions for setting up and using the NanoWaves admin panel.

## Features

The admin panel includes:
- ✅ Dashboard with statistics and recent subscriptions
- ✅ Plan management (Create, Read, Update, Delete)
- ✅ Customer/Subscription management
- ✅ Search and filter functionality
- ✅ Status management for subscriptions
- ✅ Secure authentication with admin-only access

## Setup Instructions

### 1. Run Migrations

First, run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

This will:
- Add the `is_admin` field to the users table
- Create plans and subscriptions tables (if not already created)

### 2. Seed Admin User

Run the database seeder to create the default admin user:

```bash
php artisan db:seed
```

Or seed only the admin user:

```bash
php artisan db:seed --class=AdminUserSeeder
```

**Default Admin Credentials:**
- **Email:** admin@nanowaves.com
- **Password:** admin123

**⚠️ IMPORTANT:** Change the default password immediately after first login!

### 3. Access the Admin Panel

1. Navigate to: `http://your-domain.com/admin/login`
2. Login with the admin credentials
3. You'll be redirected to the dashboard

## Admin Panel Routes

### Authentication
- `/admin/login` - Admin login page
- `POST /admin/login` - Process login
- `POST /admin/logout` - Logout

### Dashboard
- `/admin/dashboard` - Main dashboard with statistics

### Plans Management
- `/admin/plans` - List all plans
- `/admin/plans/create` - Create new plan
- `/admin/plans/{plan}` - View plan details
- `/admin/plans/{plan}/edit` - Edit plan
- `DELETE /admin/plans/{plan}` - Delete plan

### Subscriptions Management
- `/admin/subscriptions` - List all subscriptions/customers
- `/admin/subscriptions/{subscription}` - View subscription details
- `PUT /admin/subscriptions/{subscription}/status` - Update subscription status
- `DELETE /admin/subscriptions/{subscription}` - Delete subscription

## Creating Additional Admin Users

You can create additional admin users through Tinker:

```bash
php artisan tinker
```

Then run:

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => Hash::make('secure_password'),
    'is_admin' => true,
]);
```

## Features Overview

### Dashboard
- View total plans count
- View active plans count
- View total subscriptions
- View total revenue
- See recent subscriptions

### Plan Management
- Create new plans with features
- Edit existing plans
- Mark plans as popular
- Activate/deactivate plans
- Delete plans (with protection for plans with active subscriptions)

### Subscription Management
- View all customer subscriptions
- Search by customer name, email, phone, or payment ID
- Filter by subscription status (pending, completed, failed, cancelled)
- View detailed subscription information
- Update subscription status
- Delete subscriptions

## Security

- All admin routes are protected by `AdminMiddleware`
- Only users with `is_admin = true` can access admin panel
- Non-admin users attempting to access admin routes will be redirected
- Session-based authentication
- CSRF protection on all forms

## Customization

### Changing Admin Email/Password

Edit `database/seeders/AdminUserSeeder.php` and update the credentials, then re-run the seeder.

### Adding More Admin Features

1. Create new controllers in `app/Http/Controllers/Admin/`
2. Add routes in `routes/web.php` within the admin middleware group
3. Create views in `resources/views/admin/`

## Troubleshooting

### Cannot Access Admin Panel

1. Ensure you've run migrations: `php artisan migrate`
2. Ensure admin user exists: Check database or re-run seeder
3. Check that `is_admin` field is set to `true` for your user
4. Clear cache: `php artisan config:clear` and `php artisan cache:clear`

### Middleware Not Working

1. Check `bootstrap/app.php` - middleware should be registered
2. Ensure route uses `middleware(['admin'])`
3. Clear config cache: `php artisan config:clear`

### Views Not Found

1. Ensure all view files exist in `resources/views/admin/`
2. Clear view cache: `php artisan view:clear`

## Support

For issues or questions, check:
- Laravel Documentation: https://laravel.com/docs
- Application logs: `storage/logs/laravel.log`

