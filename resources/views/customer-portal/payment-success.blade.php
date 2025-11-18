@extends('layouts.app')

@section('title', 'Payment Successful - NanoWaves')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 text-center">
            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Success Message -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Payment Successful!</h1>
            <p class="text-lg text-gray-600 mb-8">
                Thank you for subscribing to {{ $subscription->plan->name }}. Your subscription has been activated successfully.
            </p>

            <!-- Subscription Details -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Subscription Details</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Plan Name:</span>
                        <span class="font-semibold text-gray-900">{{ $subscription->plan->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Amount Paid:</span>
                        <span class="font-semibold text-gray-900">₹{{ number_format($subscription->amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Payment ID:</span>
                        <span class="font-semibold text-gray-900 text-sm">{{ $subscription->razorpay_payment_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subscribed On:</span>
                        <span class="font-semibold text-gray-900">{{ $subscription->subscribed_at->format('M d, Y') }}</span>
                    </div>
                    @if($subscription->expires_at)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Expires On:</span>
                            <span class="font-semibold text-gray-900">{{ $subscription->expires_at->format('M d, Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Customer Information</h2>
                <div class="space-y-2">
                    <p><span class="text-gray-600">Name:</span> <span class="font-semibold">{{ $subscription->customer_name }}</span></p>
                    <p><span class="text-gray-600">Email:</span> <span class="font-semibold">{{ $subscription->customer_email }}</span></p>
                    <p><span class="text-gray-600">Phone:</span> <span class="font-semibold">{{ $subscription->customer_phone }}</span></p>
                    @if($subscription->customer_address)
                        <p><span class="text-gray-600">Address:</span> <span class="font-semibold">{{ $subscription->customer_address }}</span></p>
                    @endif
                    @if($subscription->city || $subscription->state)
                        <p><span class="text-gray-600">Location:</span> 
                            <span class="font-semibold">
                                {{ $subscription->city }}{{ $subscription->city && $subscription->state ? ', ' : '' }}{{ $subscription->state }}
                                @if($subscription->pincode) - {{ $subscription->pincode }}@endif
                                @if($subscription->country), {{ $subscription->country }}@endif
                            </span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('plans.index') }}" 
                    class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    View All Plans
                </a>
                <a href="/" 
                    class="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

