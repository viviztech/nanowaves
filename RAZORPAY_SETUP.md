# Razorpay Payment Gateway Setup

This document provides instructions for setting up the Razorpay payment gateway in your NanoWaves application.

## Prerequisites

1. A Razorpay account (Sign up at https://razorpay.com/)
2. Razorpay API keys (Key ID and Key Secret)

## Setup Steps

### 1. Get Your Razorpay API Keys

1. Log in to your Razorpay Dashboard: https://dashboard.razorpay.com/
2. Navigate to **Settings** → **API Keys**
3. Generate or copy your **Key ID** and **Key Secret**
   - For testing, use Test Mode keys
   - For production, use Live Mode keys

### 2. Configure Environment Variables

Add the following to your `.env` file:

```env
RAZORPAY_KEY_ID=your_key_id_here
RAZORPAY_KEY_SECRET=your_key_secret_here
```

**Important:** Never commit your `.env` file to version control. Keep your keys secure.

### 3. Run Database Migrations

```bash
php artisan migrate
```

### 4. Seed Sample Plans

```bash
php artisan db:seed --class=PlanSeeder
```

Or run all seeders:

```bash
php artisan db:seed
```

## Routes

The following routes are available:

- `/plans` - Customer portal to view all plans
- `/plans/{plan}` - View specific plan details
- `/checkout/{plan}` - Checkout page for a plan
- `/payment/success/{subscription}` - Payment success page
- `/payment/failed` - Payment failure page

## Testing

### Test Mode

For testing payments, use Razorpay's test mode:

1. Use Test Mode API keys from your Razorpay dashboard
2. Use test card numbers:
   - **Success:** 4111 1111 1111 1111
   - **Failure:** 4000 0000 0000 0002
   - **CVV:** Any 3 digits
   - **Expiry:** Any future date

### Production Mode

1. Switch to Live Mode in Razorpay Dashboard
2. Update your `.env` with Live Mode API keys
3. Ensure your domain is whitelisted in Razorpay settings

## Features

- ✅ Plan selection and display
- ✅ Customer information collection
- ✅ Razorpay payment integration
- ✅ Payment verification and signature validation
- ✅ Subscription management
- ✅ Payment success/failure handling

## Troubleshooting

### Payment Not Processing

1. Check that your API keys are correct in `.env`
2. Verify that your domain is whitelisted in Razorpay dashboard
3. Check Laravel logs: `storage/logs/laravel.log`

### Signature Verification Failed

- Ensure you're using the correct Key Secret
- Check that payment data is being passed correctly
- Verify the payment callback URL is correct

## Support

For Razorpay API documentation, visit: https://razorpay.com/docs/

For Laravel-specific issues, check the Laravel documentation: https://laravel.com/docs

