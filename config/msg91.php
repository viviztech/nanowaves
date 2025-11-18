<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MSG91 SMS Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure your MSG91 SMS gateway settings.
    | Get your API key from: https://control.msg91.com/
    |
    */

    'auth_key' => env('MSG91_AUTH_KEY', ''),
    
    'sender_id' => env('MSG91_SENDER_ID', 'NANOWS'),
    
    'route' => env('MSG91_ROUTE', '4'), // 4 = Transactional, 1 = Promotional
    
    'otp_message' => env('MSG91_OTP_MESSAGE', 'Your OTP for NanoWaves registration is {{otp}}. Valid for 10 minutes.'),
    
    'otp_length' => env('MSG91_OTP_LENGTH', 6),
    
    'otp_expiry' => env('MSG91_OTP_EXPIRY', 10), // in minutes
];

