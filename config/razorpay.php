<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Razorpay Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure your Razorpay payment gateway settings.
    | Get your API keys from: https://dashboard.razorpay.com/app/keys
    |
    */

    'key_id' => env('RAZORPAY_KEY_ID', ''),
    'key_secret' => env('RAZORPAY_KEY_SECRET', ''),
];

