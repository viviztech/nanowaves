@extends('admin.layout')

@section('title', 'Edit Plan')
@section('page-title', 'Edit Plan: ' . $plan->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.plans.update', $plan) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Plan Name *</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $plan->name) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (₹) *</label>
                <input type="number" step="0.01" name="price" id="price" required value="{{ old('price', $plan->price) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="billing_period" class="block text-sm font-medium text-gray-700 mb-2">Billing Period *</label>
                <select name="billing_period" id="billing_period" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="monthly" {{ old('billing_period', $plan->billing_period) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ old('billing_period', $plan->billing_period) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
                @error('billing_period') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="speed" class="block text-sm font-medium text-gray-700 mb-2">Internet Speed</label>
                <input type="text" name="speed" id="speed" value="{{ old('speed', $plan->speed) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="e.g., 50 Mbps">
                @error('speed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="plan_type" class="block text-sm font-medium text-gray-700 mb-2">Plan Type</label>
                <select name="plan_type" id="plan_type"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Plan Type</option>
                    <option value="home" {{ old('plan_type', $plan->plan_type) == 'home' ? 'selected' : '' }}>Home Plans</option>
                    <option value="corporate" {{ old('plan_type', $plan->plan_type) == 'corporate' ? 'selected' : '' }}>Corporate Plans</option>
                    <option value="ott" {{ old('plan_type', $plan->plan_type) == 'ott' ? 'selected' : '' }}>OTT & IP TV Plans</option>
                    <optgroup label="Legacy Types">
                        <option value="tv" {{ old('plan_type', $plan->plan_type) == 'tv' ? 'selected' : '' }}>TV (Legacy)</option>
                        <option value="bundle" {{ old('plan_type', $plan->plan_type) == 'bundle' ? 'selected' : '' }}>Bundle (Legacy)</option>
                    </optgroup>
                </select>
                <p class="text-xs text-gray-500 mt-1">Select the category this plan belongs to</p>
                @error('plan_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $plan->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                <div id="features-container">
                    @foreach(old('features', $plan->features ?? []) as $feature)
                        <div class="flex mb-2">
                            <input type="text" name="features[]" value="{{ $feature }}"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" onclick="this.parentElement.remove()" class="ml-2 text-red-600">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="addFeature()" class="mt-2 text-blue-600 hover:text-blue-800">+ Add Feature</button>
            </div>

            <div class="md:col-span-2 flex items-center space-x-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $plan->is_popular) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Mark as Popular</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $plan->is_active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.plans.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Update Plan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'flex mb-2';
    div.innerHTML = `
        <input type="text" name="features[]" 
            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        <button type="button" onclick="this.parentElement.remove()" class="ml-2 text-red-600">Remove</button>
    `;
    container.appendChild(div);
}
</script>
@endpush
@endsection

