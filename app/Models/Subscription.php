<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'plan_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'city',
        'state',
        'pincode',
        'country',
        'ip_address',
        'amount',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'status',
        'subscribed_at',
        'expires_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'subscribed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
