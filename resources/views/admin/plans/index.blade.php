@extends('admin.layout')

@section('title', 'Manage Plans')
@section('page-title', 'Manage Plans')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Plans Management</h1>
    <a href="{{ route('admin.plans.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        + Add New Plan
    </a>
</div>

<!-- Plan Type Tabs -->
<div class="mb-4 bg-white rounded-lg shadow p-4">
    <div class="flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.plans.index') }}" 
           class="px-4 py-2 rounded-lg font-medium transition {{ !request('plan_type') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            All Plans ({{ $planTypeCounts['all'] }})
        </a>
        <a href="{{ route('admin.plans.index', ['plan_type' => 'home']) }}" 
           class="px-4 py-2 rounded-lg font-medium transition {{ request('plan_type') == 'home' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Home Plans ({{ $planTypeCounts['home'] }})
        </a>
        <a href="{{ route('admin.plans.index', ['plan_type' => 'corporate']) }}" 
           class="px-4 py-2 rounded-lg font-medium transition {{ request('plan_type') == 'corporate' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            Corporate Plans ({{ $planTypeCounts['corporate'] }})
        </a>
        <a href="{{ route('admin.plans.index', ['plan_type' => 'ott']) }}" 
           class="px-4 py-2 rounded-lg font-medium transition {{ request('plan_type') == 'ott' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            OTT & IP TV Plans ({{ $planTypeCounts['ott'] }})
        </a>
        @if($planTypeCounts['legacy'] > 0)
            <a href="{{ route('admin.plans.index', ['plan_type' => 'legacy']) }}" 
               class="px-4 py-2 rounded-lg font-medium transition {{ request('plan_type') == 'legacy' ? 'bg-yellow-600 text-white' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                Legacy Plans ({{ $planTypeCounts['legacy'] }})
            </a>
        @endif
    </div>

    <!-- Search and Filter -->
    <form method="GET" action="{{ route('admin.plans.index') }}" class="flex flex-wrap gap-4">
        @if(request('plan_type'))
            <input type="hidden" name="plan_type" value="{{ request('plan_type') }}">
        @endif
        <input type="text" name="search" placeholder="Search plans..." 
            value="{{ request('search') }}"
            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Filter</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.plans.index', request('plan_type') ? ['plan_type' => request('plan_type')] : []) }}" 
               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Clear</a>
        @endif
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Speed</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($plans as $plan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $plan->name }}</div>
                        <div class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($plan->description ?? '', 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($plan->plan_type)
                            @if($plan->plan_type == 'home')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Home
                                </span>
                            @elseif($plan->plan_type == 'corporate')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    Corporate
                                </span>
                            @elseif($plan->plan_type == 'ott')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    OTT & IP TV
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ ucfirst($plan->plan_type) }}
                                </span>
                            @endif
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                No Type
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($plan->price, 2) }}/{{ $plan->billing_period }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $plan->speed ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $plan->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($plan->is_popular)
                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Popular
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.plans.show', $plan) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="{{ route('admin.plans.edit', $plan) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this plan?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No plans found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $plans->links() }}
</div>
@endsection

