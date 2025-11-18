@extends('admin.layout')

@section('title', 'Subscription Details')
@section('page-title', 'Subscription Details')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <a href="{{ route('admin.subscriptions.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Subscriptions</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-4">Customer Information</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="text-sm text-gray-900">{{ $subscription->customer_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="text-sm text-gray-900">{{ $subscription->customer_email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="text-sm text-gray-900">{{ $subscription->customer_phone }}</dd>
                </div>
                @if($subscription->customer_address)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->customer_address }}</dd>
                    </div>
                @endif
                @if($subscription->city)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">City</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->city }}</dd>
                    </div>
                @endif
                @if($subscription->state)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">State</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->state }}</dd>
                    </div>
                @endif
                @if($subscription->pincode)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Pincode</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->pincode }}</dd>
                    </div>
                @endif
                @if($subscription->country)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Country</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->country }}</dd>
                    </div>
                @endif
                @if($subscription->ip_address)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">IP Address</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->ip_address }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Subscription Details</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Plan</dt>
                    <dd class="text-sm text-gray-900">{{ $subscription->plan->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Amount</dt>
                    <dd class="text-sm text-gray-900">₹{{ number_format($subscription->amount, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($subscription->status === 'completed') bg-green-100 text-green-800
                            @elseif($subscription->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($subscription->status === 'failed') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($subscription->status) }}
                        </span>
                    </dd>
                </div>
                @if($subscription->razorpay_order_id)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Razorpay Order ID</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->razorpay_order_id }}</dd>
                    </div>
                @endif
                @if($subscription->razorpay_payment_id)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Razorpay Payment ID</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->razorpay_payment_id }}</dd>
                    </div>
                @endif
                @if($subscription->subscribed_at)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Subscribed At</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->subscribed_at->format('M d, Y H:i') }}</dd>
                    </div>
                @endif
                @if($subscription->expires_at)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Expires At</dt>
                        <dd class="text-sm text-gray-900">{{ $subscription->expires_at->format('M d, Y H:i') }}</dd>
                    </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="text-sm text-gray-900">{{ $subscription->created_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="text-lg font-semibold mb-4">Update Status</h3>
        <form action="{{ route('admin.subscriptions.update-status', $subscription) }}" method="POST" class="flex items-center space-x-4">
            @csrf
            @method('PUT')
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $subscription->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ $subscription->status == 'failed' ? 'selected' : '' }}>Failed</option>
                <option value="cancelled" {{ $subscription->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Update Status
            </button>
        </form>
    </div>
</div>
@endsection

