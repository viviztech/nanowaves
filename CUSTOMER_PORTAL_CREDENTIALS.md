# Customer Portal Credentials

This document provides information about accessing the NanoWaves customer portal and test credentials.

## Accessing the Customer Portal

### Login URL
- **Customer Login:** `http://your-domain.com/customer/login`
- **Customer Dashboard:** `http://your-domain.com/customer/dashboard` (requires login)

## Test Customer Credentials

After running the database seeder, you can use the following test customer accounts:

### Primary Test Customer
- **Email:** `customer@nanowaves.com`
- **Password:** `customer123`
- **Name:** Test Customer

### Additional Test Customers
- **Email:** `john.doe@example.com`
- **Password:** `password123`
- **Name:** John Doe

- **Email:** `jane.smith@example.com`
- **Password:** `password123`
- **Name:** Jane Smith

### Factory-Generated Test User
- **Email:** `test@example.com`
- **Password:** `password`
- **Name:** Test User

## Setting Up Test Customers

### Option 1: Run All Seeders
```bash
php artisan db:seed
```

This will create:
- Admin user
- Customer users
- Plans
- Roles and permissions

### Option 2: Run Only Customer Seeder
```bash
php artisan db:seed --class=CustomerUserSeeder
```

### Option 3: Create Customer via Tinker
```bash
php artisan tinker
```

Then run:
```php
$user = \App\Models\User::create([
    'name' => 'Your Name',
    'email' => 'your.email@example.com',
    'password' => \Illuminate\Support\Facades\Hash::make('your-password'),
    'is_admin' => false,
]);
```

## How Customers Are Created

Customers can be created in two ways:

1. **Automatic Creation During Subscription:**
   - When a customer subscribes to a plan through the checkout process
   - User account is automatically created with the email and password provided during checkout
   - The customer can then log in using these credentials

2. **Manual Creation:**
   - Admin can create customer accounts through the admin panel (`/admin/users`)
   - Or via database seeder (as shown above)

## Customer Portal Features

Once logged in, customers can:
- View their dashboard
- Manage their subscriptions
- View plan details
- Access account information

## Security Notes

⚠️ **IMPORTANT:** 
- These are test credentials for development only
- Change all default passwords in production
- Never commit real customer credentials to version control
- Use strong, unique passwords for production accounts

## Troubleshooting

### Cannot Login
1. Verify the user exists in the database:
   ```bash
   php artisan tinker
   User::where('email', 'customer@nanowaves.com')->first();
   ```

2. Reset password:
   ```bash
   php artisan tinker
   $user = User::where('email', 'customer@nanowaves.com')->first();
   $user->password = \Illuminate\Support\Facades\Hash::make('newpassword');
   $user->save();
   ```

3. Check if user is admin (admins are redirected to admin panel):
   ```bash
   php artisan tinker
   User::where('email', 'customer@nanowaves.com')->first()->is_admin;
   ```

### Redirected to Admin Panel
- If a user has `is_admin = true`, they will be redirected to the admin panel
- To make them a regular customer, set `is_admin = false`:
  ```bash
  php artisan tinker
  $user = User::where('email', 'customer@nanowaves.com')->first();
  $user->is_admin = false;
  $user->save();
  ```

## Admin Credentials (for reference)

- **Email:** `admin@nanowaves.com`
- **Password:** `admin123`
- **Login URL:** `http://your-domain.com/admin/login`

