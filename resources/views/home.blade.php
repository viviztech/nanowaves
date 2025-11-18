@extends('layouts.app')

@section('title', 'NanoWaves - Fast & Reliable Internet Service Provider')

@section('content')
    <!-- Hero Banner - Full Page -->
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <!-- Animated Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-indigo-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-8">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium">Award-Winning Internet Provider</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight">
                    <span class="block">Lightning-Fast</span>
                    <span class="block bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent">
                        Internet Service
                    </span>
                </h1>
                
                <!-- Subheading -->
                <p class="text-xl md:text-2xl lg:text-3xl mb-4 text-blue-100 max-w-3xl mx-auto font-light">
                    Experience unlimited data, award-winning support, and blazing speeds
                </p>
                <p class="text-lg md:text-xl mb-12 text-blue-200 max-w-2xl mx-auto">
                    No lock-in contracts • 100% Local Support • Easy Setup
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <a href="{{ route('plans.index') }}" class="group relative bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 text-lg shadow-2xl hover:shadow-blue-500/50 hover:scale-105 flex items-center gap-2">
                        <span>View Plans</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="#check-address" class="group bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-8 py-4 rounded-xl font-semibold hover:bg-white/20 transition-all duration-300 text-lg hover:scale-105 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Check Availability</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap justify-center items-center gap-8 text-sm text-blue-200">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Unlimited Data</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>No Contracts</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Awards Section -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Recognized Excellence</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Award-winning service trusted by thousands of customers</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group text-center">
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:-translate-y-1">
                        <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Most Trusted Internet Provider</h3>
                        <p class="text-blue-600 font-semibold mb-2">2023-2025</p>
                        <p class="text-gray-600">Canstar Blue</p>
                    </div>
                </div>
                <div class="group text-center">
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:-translate-y-1">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Most Satisfied Customers</h3>
                        <p class="text-blue-600 font-semibold mb-2">2025</p>
                        <p class="text-gray-600">Canstar Blue</p>
                    </div>
                </div>
                <div class="group text-center">
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:-translate-y-1">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Most Trusted Brand</h3>
                        <p class="text-blue-600 font-semibold mb-2">Telecommunications 2024</p>
                        <p class="text-gray-600">Roy Morgan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotional Banner -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-block bg-yellow-400 text-blue-900 px-4 py-1 rounded-full text-sm font-bold mb-4">
                LIMITED TIME OFFER
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Special Deals Available Now</h2>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-2xl mx-auto">Get more value across mobile and broadband with our exclusive offers.</p>
            <a href="#plans" class="inline-flex items-center gap-2 bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-105">
                <span>View All Offers</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Complete Solutions for Every Need</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">From home internet to mobile services, we've got you covered</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="group bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-900">Internet Plans</h3>
                    <p class="text-sm text-gray-600">Fast and reliable internet connections</p>
                </div>
                <div class="group bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-900">Mobile SIM Plans</h3>
                    <p class="text-sm text-gray-600">Flexible mobile plans with great coverage</p>
                </div>
                <div class="group bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-900">Mobile Broadband</h3>
                    <p class="text-sm text-gray-600">Internet on the go</p>
                </div>
                <div class="group bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-900">Modems & Hardware</h3>
                    <p class="text-sm text-gray-600">Quality equipment for your connection</p>
                </div>
                <div class="group bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-900">Home Phone</h3>
                    <p class="text-sm text-gray-600">Keep your home phone service</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Internet Plans Section -->
    <section id="plans" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Choose Your Perfect Plan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Great value bundles - TV + Internet packages for every need</p>
            </div>

            <!-- Plan Type Tabs -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button onclick="showHomePlanType('home')" id="home-tab-home" class="home-plan-tab px-6 py-3 font-semibold text-base rounded-lg transition-all duration-300 bg-blue-600 text-white shadow-lg hover:shadow-xl transform hover:scale-105">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home Plans
                    </span>
                </button>
                <button onclick="showHomePlanType('corporate')" id="home-tab-corporate" class="home-plan-tab px-6 py-3 font-semibold text-base rounded-lg transition-all duration-300 text-gray-700 hover:bg-gray-100 hover:shadow-md transform hover:scale-105">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Corporate Plans
                    </span>
                </button>
                <button onclick="showHomePlanType('ott')" id="home-tab-ott" class="home-plan-tab px-6 py-3 font-semibold text-base rounded-lg transition-all duration-300 text-gray-700 hover:bg-gray-100 hover:shadow-md transform hover:scale-105">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        OTT & IP TV Plans
                    </span>
                </button>
            </div>

            <!-- Home Plans Section -->
            <div id="home-plans-home" class="home-plan-section">
                @if($homePlans->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach($homePlans as $plan)
                            @include('customer-portal.plan-card', ['plan' => $plan])
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-2xl shadow">
                        <p class="text-gray-600 text-lg">No home plans available at the moment. Please check back later.</p>
                        <a href="{{ route('plans.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">View All Plans</a>
                    </div>
                @endif
            </div>

            <!-- Corporate Plans Section -->
            <div id="home-plans-corporate" class="home-plan-section hidden">
                @if($corporatePlans->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach($corporatePlans as $plan)
                            @include('customer-portal.plan-card', ['plan' => $plan])
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-2xl shadow">
                        <p class="text-gray-600 text-lg">No corporate plans available at the moment. Please check back later.</p>
                        <a href="{{ route('plans.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">View All Plans</a>
                    </div>
                @endif
            </div>

            <!-- OTT & IP TV Plans Section -->
            <div id="home-plans-ott" class="home-plan-section hidden">
                @if($ottPlans->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach($ottPlans as $plan)
                            @include('customer-portal.plan-card', ['plan' => $plan])
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-white rounded-2xl shadow">
                        <p class="text-gray-600 text-lg">No OTT & IP TV plans available at the moment. Please check back later.</p>
                        <a href="{{ route('plans.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">View All Plans</a>
                    </div>
                @endif
            </div>

            <!-- View All Plans CTA -->
            <div class="text-center mt-12">
                <a href="{{ route('plans.index') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                    <span>View All Plans</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- High-speed Plans Banner -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">The High-speed future is here</h2>
            <p class="text-xl mb-8 text-blue-100">Check out our new high-speed plans & make sure you get the most out of your internet.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#plans" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">
                    Explore high-speed plans
                </a>
                <a href="#" class="bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 transition">
                    Find out more
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Why Choose NanoWaves?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">We're committed to providing the best internet experience with award-winning service</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">100% Local Support</h3>
                    <p class="text-gray-600 leading-relaxed">When you need support, our local team will be there to help. We invest in local jobs – because we think it's the right thing to do.</p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Unlimited Data</h3>
                    <p class="text-gray-600 leading-relaxed">All our plans come with the option of unlimited data so you can stream, work or play to your heart's content – your household will never be caught short.</p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Award-winning Telco</h3>
                    <p class="text-gray-600 leading-relaxed">At NanoWaves we love to go above and beyond for our customers. We've been recognised for our quality by industry leaders.</p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Fast, Easy Setup</h3>
                    <p class="text-gray-600 leading-relaxed">We understand you can't go without internet. That's why we make switching easy and hassle free – it only takes minutes (not hours) to sign up.</p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Award-winning Customer Service</h3>
                    <p class="text-gray-600 leading-relaxed">We've won customer service awards from industry leaders. Rest assured our experts will help you resolve any problems quickly and painlessly.</p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-gray-100 hover:border-blue-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="bg-gradient-to-br from-red-500 to-red-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">No Lock-in Contracts</h3>
                    <p class="text-gray-600 leading-relaxed">We don't offer contracts because we believe our service is so good you won't want to go anywhere else.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Address Check Section -->
    <section id="check-address" class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
                <h2 class="text-3xl font-bold text-center mb-4">Ready for reliable internet?</h2>
                <p class="text-center text-gray-600 mb-8">Check your address below to get started</p>
                
                <form class="space-y-4">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter your address" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="property-type" class="block text-sm font-medium text-gray-700 mb-2">Property type</label>
                        <select id="property-type" name="property-type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="home">Home</option>
                            <option value="business">Business</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Find Plans
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-center text-gray-600 mb-4">or</p>
                    <h3 class="text-xl font-semibold text-center mb-4">Check what speeds are available at your address</h3>
                    <p class="text-center text-gray-600 mb-6">Enter your details and one of our local experts will get back to you.</p>
                    
                    <form class="space-y-4">
                        <input type="text" placeholder="Address" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <input type="text" placeholder="Name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <input type="tel" placeholder="Phone" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <input type="email" placeholder="Email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Check Address
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Locations Section -->
    <section id="service-locations" class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Service Locations</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    We proudly serve these areas with fast, reliable internet connectivity
                </p>
            </div>

            <!-- Locations Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
                @php
                    $locations = [
                        'Karur',
                        'Velliyanai',
                        'Palayam',
                        'Guziliamparai',
                        'Kovilur',
                        'Kaniyalampatti',
                        'Jegathabi',
                        'Uppidamangalam',
                        'Puliyur'
                    ];
                @endphp

                @foreach($locations as $location)
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-gray-100 hover:border-blue-300 hover:-translate-y-1 group">
                        <div class="flex items-center justify-center mb-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 text-center group-hover:text-blue-600 transition-colors">
                            {{ $location }}
                        </h3>
                    </div>
                @endforeach
            </div>

            <!-- Map or Additional Info -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border-2 border-blue-200">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Coverage Area</h3>
                    <p class="text-gray-700 mb-6 max-w-2xl mx-auto">
                        NanoWaves provides high-speed internet services across these locations in and around Karur district. 
                        Our network infrastructure ensures reliable connectivity for homes and businesses in these areas.
                    </p>
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach($locations as $location)
                            <span class="inline-flex items-center px-4 py-2 bg-white rounded-full text-sm font-medium text-gray-700 shadow-sm border border-gray-200">
                                <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                {{ $location }}
                            </span>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Check Availability in Your Area
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
    function showHomePlanType(type) {
        // Hide all plan sections with fade out
        document.querySelectorAll('.home-plan-section').forEach(section => {
            section.style.opacity = '0';
            setTimeout(() => {
                section.classList.add('hidden');
            }, 150);
        });
        
        // Remove active state from all tabs
        document.querySelectorAll('.home-plan-tab').forEach(tab => {
            tab.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'hover:shadow-xl');
            tab.classList.add('text-gray-700', 'hover:bg-gray-100', 'hover:shadow-md');
        });
        
        // Show selected plan section with fade in
        setTimeout(() => {
            const selectedSection = document.getElementById('home-plans-' + type);
            selectedSection.classList.remove('hidden');
            setTimeout(() => {
                selectedSection.style.opacity = '1';
            }, 10);
        }, 150);
        
        // Add active state to selected tab
        const activeTab = document.getElementById('home-tab-' + type);
        activeTab.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'hover:shadow-xl');
        activeTab.classList.remove('text-gray-700', 'hover:bg-gray-100', 'hover:shadow-md');
    }
    
    // Initialize opacity for plan sections
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.home-plan-section').forEach(section => {
            section.style.transition = 'opacity 0.3s ease-in-out';
            if (!section.classList.contains('hidden')) {
                section.style.opacity = '1';
            }
        });
    });
</script>
@endpush
@endsection

