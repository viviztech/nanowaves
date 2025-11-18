<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(
            config('razorpay.key_id'),
            config('razorpay.key_secret')
        );
    }

    /**
     * Show checkout page for a plan
     */
    public function checkout(Plan $plan)
    {
        return view('customer-portal.checkout', compact('plan'));
    }

    /**
     * Create Razorpay order
     */
    public function createOrder(Request $request, Plan $plan)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'country' => 'required|string|max:255',
        ]);

        try {
            // Get IP address
            $ipAddress = $request->ip();
            
            // Create subscription record
            $subscription = Subscription::create([
                'plan_id' => $plan->id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'country' => $request->country ?? 'India',
                'ip_address' => $ipAddress,
                'amount' => $plan->price,
                'status' => 'pending',
            ]);

            // Create Razorpay order
            $orderData = [
                'receipt' => 'order_' . $subscription->id,
                'amount' => $plan->price * 100, // Amount in paise
                'currency' => 'INR',
                'notes' => [
                    'subscription_id' => $subscription->id,
                    'plan_id' => $plan->id,
                    'customer_email' => $request->customer_email,
                ],
            ];

            $razorpayOrder = $this->razorpay->order->create($orderData);

            // Update subscription with Razorpay order ID
            $subscription->update([
                'razorpay_order_id' => $razorpayOrder['id'],
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'key_id' => config('razorpay.key_id'),
                'subscription_id' => $subscription->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order. Please try again.',
            ], 500);
        }
    }

    /**
     * Handle payment success callback
     */
    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);

        try {
            $subscription = Subscription::findOrFail($request->subscription_id);

            // Verify payment signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $this->razorpay->utility->verifyPaymentSignature($attributes);

            // Update subscription
            $subscription->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'status' => 'completed',
                'subscribed_at' => now(),
                'expires_at' => now()->addMonth(), // Set expiry based on billing period
            ]);

            return redirect()->route('payment.success-page', ['subscription' => $subscription->id])
                ->with('success', 'Payment successful! Your subscription has been activated.');
        } catch (\Exception $e) {
            Log::error('Payment verification failed: ' . $e->getMessage());
            return redirect()->route('plans.index')
                ->with('error', 'Payment verification failed. Please contact support.');
        }
    }

    /**
     * Show payment success page
     */
    public function success(Subscription $subscription)
    {
        return view('customer-portal.payment-success', compact('subscription'));
    }

    /**
     * Handle payment failure
     */
    public function paymentFailed(Request $request)
    {
        if ($request->has('subscription_id')) {
            $subscription = Subscription::find($request->subscription_id);
            if ($subscription) {
                $subscription->update(['status' => 'failed']);
            }
        }

        return redirect()->route('plans.index')
            ->with('error', 'Payment failed. Please try again.');
    }
}
