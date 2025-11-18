@extends('admin.layout')

@section('title', 'Manage Subscriptions')
@section('page-title', 'Manage Subscriptions')

@section('content')
<div class="mb-4">
    <form method="GET" action="{{ route('admin.subscriptions.index') }}" class="flex flex-wrap gap-4 mb-4">
        <input type="text" name="search" placeholder="Search by name, email, phone..." 
            value="{{ request('search') }}"
            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Statuses</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Filter</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.subscriptions.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Clear</a>
        @endif
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($subscriptions as $subscription)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $subscription->customer_name }}</div>
                        <div class="text-sm text-gray-500">{{ $subscription->customer_email }}</div>
                        <div class="text-sm text-gray-500">{{ $subscription->customer_phone }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($subscription->city || $subscription->state)
                            <div class="text-sm text-gray-900">
                                {{ $subscription->city }}{{ $subscription->city && $subscription->state ? ', ' : '' }}{{ $subscription->state }}
                            </div>
                            @if($subscription->pincode)
                                <div class="text-sm text-gray-500">{{ $subscription->pincode }}</div>
                            @endif
                            @if($subscription->ip_address)
                                <div class="text-xs text-gray-400">IP: {{ $subscription->ip_address }}</div>
                            @endif
                        @else
                            <span class="text-sm text-gray-400">N/A</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $subscription->plan->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($subscription->amount, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($subscription->status === 'completed') bg-green-100 text-green-800
                            @elseif($subscription->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($subscription->status === 'failed') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($subscription->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $subscription->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="text-blue-600 hover:text-blue-900">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">No subscriptions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $subscriptions->links() }}
</div>
@endsection

