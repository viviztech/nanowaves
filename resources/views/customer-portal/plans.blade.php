@extends('layouts.app')

@section('title', 'Select Your Plan - NanoWaves')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Choose Your Perfect Plan</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Select a plan that fits your needs and complete your subscription</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Plan Type Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-12 border-b border-gray-200 pb-4">
            <button onclick="showPlanType('home')" id="tab-home" class="plan-tab px-8 py-3 font-semibold text-lg rounded-lg transition-all duration-300 bg-blue-600 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home Plans
                </span>
            </button>
            <button onclick="showPlanType('corporate')" id="tab-corporate" class="plan-tab px-8 py-3 font-semibold text-lg rounded-lg transition-all duration-300 text-gray-700 hover:bg-gray-100 hover:shadow-md transform hover:scale-105">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Corporate Plans
                </span>
            </button>
            <button onclick="showPlanType('ott')" id="tab-ott" class="plan-tab px-8 py-3 font-semibold text-lg rounded-lg transition-all duration-300 text-gray-700 hover:bg-gray-100 hover:shadow-md transform hover:scale-105">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    OTT & IP TV Plans
                </span>
            </button>
        </div>

        <!-- Home Plans Section -->
        <div id="plans-home" class="plan-section" style="opacity: 1;">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Home Plans</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Fast, reliable internet for your home with unlimited data and no lock-in contracts</p>
            </div>
            
            @if($homePlans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($homePlans as $plan)
                        @include('customer-portal.plan-card', ['plan' => $plan])
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-2xl shadow">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <p class="text-gray-600 text-lg">No home plans available at the moment. Please check back later.</p>
                </div>
            @endif
        </div>

        <!-- Corporate Plans Section -->
        <div id="plans-corporate" class="plan-section hidden">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Corporate Plans</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Dedicated internet solutions for businesses with priority support and guaranteed uptime</p>
            </div>
            
            @if($corporatePlans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($corporatePlans as $plan)
                        @include('customer-portal.plan-card', ['plan' => $plan])
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-2xl shadow">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <p class="text-gray-600 text-lg">No corporate plans available at the moment. Please check back later.</p>
                </div>
            @endif
        </div>

        <!-- OTT & IP TV Plans Section -->
        <div id="plans-ott" class="plan-section hidden">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">OTT & IP TV Plans</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Complete entertainment packages with TV channels, OTT content, and high-speed internet</p>
            </div>
            
            @if($ottPlans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($ottPlans as $plan)
                        @include('customer-portal.plan-card', ['plan' => $plan])
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-2xl shadow">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-600 text-lg">No OTT & IP TV plans available at the moment. Please check back later.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
        function showPlanType(type) {
        // Hide all plan sections with fade out
        document.querySelectorAll('.plan-section').forEach(section => {
            section.style.opacity = '0';
            setTimeout(() => {
                section.classList.add('hidden');
            }, 150);
        });
        
        // Remove active state from all tabs
        document.querySelectorAll('.plan-tab').forEach(tab => {
            tab.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'hover:shadow-xl');
            tab.classList.add('text-gray-700', 'hover:bg-gray-100', 'hover:shadow-md');
        });
        
        // Show selected plan section with fade in
        setTimeout(() => {
            const selectedSection = document.getElementById('plans-' + type);
            selectedSection.classList.remove('hidden');
            setTimeout(() => {
                selectedSection.style.opacity = '1';
            }, 10);
        }, 150);
        
        // Add active state to selected tab
        const activeTab = document.getElementById('tab-' + type);
        activeTab.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'hover:shadow-xl');
        activeTab.classList.remove('text-gray-700', 'hover:bg-gray-100', 'hover:shadow-md');
    }
    
    // Initialize opacity for plan sections
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.plan-section').forEach(section => {
            section.style.transition = 'opacity 0.3s ease-in-out';
            if (!section.classList.contains('hidden')) {
                section.style.opacity = '1';
            }
        });
    });
</script>
@endpush
@endsection
