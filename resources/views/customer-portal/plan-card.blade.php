<div class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition-all duration-300 border-2 {{ $plan->is_popular ? 'border-yellow-400 scale-105' : 'border-gray-100 hover:border-blue-200' }} hover:-translate-y-2">
    @if($plan->is_popular)
        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-10">
            <span class="bg-yellow-400 text-blue-900 px-3 py-1 rounded-full text-xs font-bold shadow-lg">POPULAR</span>
        </div>
    @endif

    <div class="text-center mb-6 {{ $plan->is_popular ? 'mt-4' : '' }}">
        <h3 class="text-xl font-bold mb-2 text-gray-900">{{ $plan->name }}</h3>
        <div class="text-4xl font-bold text-blue-600 mb-2">
            ₹{{ number_format($plan->price, 2) }}<span class="text-lg text-gray-500 font-normal">/mo</span>
        </div>
        @if($plan->description)
            <p class="text-gray-600 text-sm font-medium">{{ $plan->description }}</p>
        @endif
    </div>

    @if($plan->features && is_array($plan->features))
        <ul class="space-y-3 mb-6">
            @foreach($plan->features as $feature)
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700 text-sm">{{ $feature }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    @if($plan->speed)
        <div class="mb-4 text-center">
            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                {{ $plan->speed }}
            </span>
        </div>
    @endif

    @auth
        <a href="{{ route('checkout', $plan->id) }}" class="block w-full {{ $plan->is_popular ? 'bg-gradient-to-r from-blue-600 to-indigo-600' : 'bg-blue-600' }} text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl text-sm text-center">
            Select Plan
        </a>
    @else
        <a href="{{ route('customer.register', ['plan' => $plan->id]) }}" class="block w-full {{ $plan->is_popular ? 'bg-gradient-to-r from-blue-600 to-indigo-600' : 'bg-blue-600' }} text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl text-sm text-center">
            Get Started
        </a>
    @endauth
</div>

