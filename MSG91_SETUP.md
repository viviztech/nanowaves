# MSG91 SMS Gateway Setup

This document provides instructions for setting up MSG91 SMS gateway for mobile number verification in the NanoWaves customer registration.

## Features

- ✅ OTP-based mobile number verification
- ✅ Automatic OTP generation and sending
- ✅ OTP verification with attempt limits
- ✅ Resend OTP functionality
- ✅ Timer-based OTP expiry
- ✅ Session-based verification tracking

## Setup Instructions

### 1. Get MSG91 API Credentials

1. Sign up for MSG91 account at: https://control.msg91.com/
2. Log in to your MSG91 dashboard
3. Navigate to **API** section
4. Copy your **Auth Key** (API Key)
5. Set up your **Sender ID** (6 characters, alphanumeric)
6. Ensure you have sufficient SMS credits

### 2. Configure Environment Variables

Add the following to your `.env` file:

```env
MSG91_AUTH_KEY=your_auth_key_here
MSG91_SENDER_ID=NANOWS
MSG91_ROUTE=4
```

**Configuration Details:**
- `MSG91_AUTH_KEY`: Your MSG91 authentication key
- `MSG91_SENDER_ID`: Your approved sender ID (default: NANOWS)
- `MSG91_ROUTE`: Route type (4 = Transactional, 1 = Promotional)

### 3. Customize OTP Message (Optional)

You can customize the OTP message in `.env`:

```env
MSG91_OTP_MESSAGE=Your OTP for NanoWaves registration is {{otp}}. Valid for 10 minutes.
```

The `{{otp}}` placeholder will be replaced with the actual OTP.

### 4. Clear Configuration Cache

After updating `.env`, clear the config cache:

```bash
php artisan config:clear
```

## How It Works

### Registration Flow

1. **User enters phone number** → Clicks "Send OTP"
2. **System generates OTP** → Stores in cache (10 minutes expiry)
3. **MSG91 sends SMS** → User receives OTP on their phone
4. **User enters OTP** → Clicks "Verify OTP"
5. **System verifies OTP** → Marks phone as verified in session
6. **User completes registration** → Phone verification is checked before account creation

### Security Features

- **OTP Expiry**: OTP expires after 10 minutes
- **Attempt Limits**: Maximum 5 verification attempts per OTP
- **Session Verification**: Phone verification stored in session
- **Cache-based Storage**: OTP stored securely in Laravel cache

## API Endpoints

### Send OTP
- **URL**: `POST /customer/send-otp`
- **Body**: `{ "phone": "9876543210" }`
- **Response**: `{ "success": true, "message": "OTP sent successfully" }`

### Verify OTP
- **URL**: `POST /customer/verify-otp`
- **Body**: `{ "phone": "9876543210", "otp": "123456" }`
- **Response**: `{ "success": true, "message": "Phone number verified successfully" }`

## Testing

### Test Mode

For testing without sending actual SMS:

1. Use MSG91's test credentials
2. Or mock the `Msg91Service` in tests
3. Check logs at `storage/logs/laravel.log` for OTP values

### Production Mode

1. Ensure `MSG91_AUTH_KEY` is set correctly
2. Verify sender ID is approved
3. Check SMS credits balance
4. Monitor SMS delivery in MSG91 dashboard

## Troubleshooting

### OTP Not Sending

1. **Check API Key**: Verify `MSG91_AUTH_KEY` in `.env`
2. **Check Sender ID**: Ensure sender ID is approved
3. **Check Credits**: Verify SMS credits in MSG91 dashboard
4. **Check Logs**: Review `storage/logs/laravel.log` for errors
5. **Check API Status**: Verify MSG91 API is operational

### OTP Verification Failing

1. **Check OTP Expiry**: OTP expires after 10 minutes
2. **Check Attempts**: Maximum 5 attempts per OTP
3. **Check Cache**: Ensure cache is working (Redis/Memcached recommended)
4. **Check Phone Format**: Phone should be 10 digits (without country code)

### Common Errors

- **"Failed to send OTP"**: Check API key and credits
- **"OTP expired"**: Request a new OTP
- **"Maximum attempts exceeded"**: Request a new OTP
- **"Invalid OTP"**: Double-check the entered OTP

## MSG91 API Documentation

For more details, refer to:
- MSG91 API Docs: https://docs.msg91.com/
- OTP API: https://docs.msg91.com/reference/send-otp

## Support

For MSG91-specific issues:
- MSG91 Support: https://help.msg91.com/
- MSG91 Dashboard: https://control.msg91.com/

For application issues:
- Check Laravel logs: `storage/logs/laravel.log`
- Review application error messages

