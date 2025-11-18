@extends('admin.layout')

@section('title', 'View Plan')
@section('page-title', 'Plan Details: ' . $plan->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <a href="{{ route('admin.plans.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Plans</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-4">Plan Information</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="text-sm text-gray-900">{{ $plan->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="text-sm text-gray-900">{{ $plan->description ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Price</dt>
                    <dd class="text-sm text-gray-900">₹{{ number_format($plan->price, 2) }} / {{ $plan->billing_period }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Speed</dt>
                    <dd class="text-sm text-gray-900">{{ $plan->speed ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Plan Type</dt>
                    <dd class="text-sm text-gray-900">{{ $plan->plan_type ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $plan->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($plan->is_popular)
                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Popular
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Features</h3>
            @if($plan->features && count($plan->features) > 0)
                <ul class="space-y-2">
                    @foreach($plan->features as $feature)
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-900">{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-500">No features listed</p>
            @endif
        </div>
    </div>

    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="text-lg font-semibold mb-4">Subscriptions</h3>
        <p class="text-sm text-gray-600">Total subscriptions: {{ $plan->subscriptions->count() }}</p>
        <p class="text-sm text-gray-600">Completed: {{ $plan->subscriptions->where('status', 'completed')->count() }}</p>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <a href="{{ route('admin.plans.edit', $plan) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Edit Plan
        </a>
    </div>
</div>
@endsection

