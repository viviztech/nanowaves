<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NanoWaves</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">
                Create Your Account
            </h2>
            <p class="text-gray-600">
                Sign up and select a plan to get started
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Registration Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                    <h3 class="text-xl font-bold mb-6 text-gray-900">Account Information</h3>
                    
                    <form method="POST" action="{{ route('customer.register') }}" id="register-form">
                        @csrf

                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" required 
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="John Doe">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" required 
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="john@example.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-2">
                                    <input type="tel" name="phone" id="phone" required 
                                        value="{{ old('phone') }}"
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="9876543210">
                                    <button type="button" id="send-otp-btn" 
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors whitespace-nowrap">
                                        Send OTP
                                    </button>
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">We'll send a verification code to this number</p>
                            </div>

                            <!-- OTP Verification Section -->
                            <div class="md:col-span-2 hidden" id="otp-section">
                                <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">
                                    Enter OTP <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-2">
                                    <input type="text" name="otp" id="otp" maxlength="6" 
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center text-2xl tracking-widest"
                                        placeholder="000000">
                                    <button type="button" id="verify-otp-btn" 
                                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors whitespace-nowrap">
                                        Verify OTP
                                    </button>
                                </div>
                                <div id="otp-message" class="mt-2 text-sm"></div>
                                <div class="mt-2 flex items-center justify-between">
                                    <button type="button" id="resend-otp-btn" 
                                        class="text-sm text-blue-600 hover:text-blue-700 hidden">
                                        Resend OTP
                                    </button>
                                    <span id="otp-timer" class="text-sm text-gray-500"></span>
                                </div>
                            </div>

                            <!-- Phone Verified Indicator -->
                            <div class="md:col-span-2 hidden" id="phone-verified-section">
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-green-800">Phone Number Verified</p>
                                        <p class="text-xs text-green-600">You can now proceed with registration</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password" id="password" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="••••••••">
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                            </div>

                            <div class="md:col-span-2">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Hidden plan_id field -->
                        <input type="hidden" name="plan_id" id="selected_plan_id" value="{{ old('plan_id', $selectedPlanId) }}">

                        <div class="mt-8">
                            <button type="submit" 
                                class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                Create Account & Continue
                            </button>
                        </div>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Already have an account? 
                                <a href="{{ route('customer.login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                    Sign in
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Plan Selection -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Select a Plan</h3>
                    <p class="text-sm text-gray-600 mb-6">Choose a plan that suits your needs</p>
                    
                    @if($plans->count() > 0)
                        <div class="space-y-4 max-h-[600px] overflow-y-auto">
                            @foreach($plans as $plan)
                                <div class="plan-option border-2 rounded-lg p-4 cursor-pointer transition-all 
                                    {{ old('plan_id', $selectedPlanId) == $plan->id ? 'border-blue-600 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}"
                                    onclick="selectPlan({{ $plan->id }})">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $plan->name }}</h4>
                                            @if($plan->is_popular)
                                                <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">
                                                    Popular
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-blue-600">₹{{ number_format($plan->price, 0) }}</div>
                                            <div class="text-xs text-gray-500">{{ ucfirst($plan->billing_period) }}</div>
                                        </div>
                                    </div>
                                    @if($plan->description)
                                        <p class="text-sm text-gray-600 mb-2">{{ \Illuminate\Support\Str::limit($plan->description, 60) }}</p>
                                    @endif
                                    @if($plan->speed)
                                        <p class="text-sm font-medium text-gray-700">
                                            <span class="text-blue-600">{{ $plan->speed }}</span>
                                        </p>
                                    @endif
                                    @if(old('plan_id', $selectedPlanId) == $plan->id)
                                        <div class="mt-2 text-sm text-blue-600 font-medium">
                                            ✓ Selected
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No plans available at the moment.</p>
                            <a href="{{ route('plans.index') }}" class="text-blue-600 hover:text-blue-700 mt-2 inline-block">
                                View all plans
                            </a>
                        </div>
                    @endif

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-xs text-gray-500 text-center">
                            You can change your plan later from your account dashboard.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectPlan(planId) {
            // Update hidden input
            document.getElementById('selected_plan_id').value = planId;
            
            // Update visual selection
            document.querySelectorAll('.plan-option').forEach(option => {
                option.classList.remove('border-blue-600', 'bg-blue-50');
                option.classList.add('border-gray-200');
                
                // Remove selected indicator
                const selectedIndicator = option.querySelector('.text-blue-600.font-medium');
                if (selectedIndicator && selectedIndicator.textContent.includes('✓')) {
                    selectedIndicator.remove();
                }
            });
            
            // Highlight selected plan
            event.currentTarget.classList.remove('border-gray-200');
            event.currentTarget.classList.add('border-blue-600', 'bg-blue-50');
            
            // Add selected indicator
            const selectedDiv = document.createElement('div');
            selectedDiv.className = 'mt-2 text-sm text-blue-600 font-medium';
            selectedDiv.textContent = '✓ Selected';
            event.currentTarget.appendChild(selectedDiv);
        }

        // Initialize selection on page load
        document.addEventListener('DOMContentLoaded', function() {
            const selectedPlanId = {{ old('plan_id', $selectedPlanId ?? 'null') }};
            if (selectedPlanId) {
                const planOption = document.querySelector(`[onclick="selectPlan(${selectedPlanId})"]`);
                if (planOption) {
                    planOption.click();
                }
            }
        });

        // OTP Functionality
        let otpTimer = null;
        let otpTimerSeconds = 0;

        // Send OTP
        document.getElementById('send-otp-btn').addEventListener('click', function() {
            const phoneInput = document.getElementById('phone');
            const phone = phoneInput.value.trim();

            if (!phone) {
                showOtpMessage('Please enter a phone number', 'error');
                return;
            }

            // Validate phone number (10 digits)
            if (!/^\d{10}$/.test(phone)) {
                showOtpMessage('Please enter a valid 10-digit phone number', 'error');
                return;
            }

            // Disable button and show loading
            this.disabled = true;
            this.textContent = 'Sending...';
            this.classList.add('opacity-50', 'cursor-not-allowed');

            // Send OTP request
            fetch('{{ route("customer.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ phone: phone })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showOtpMessage('OTP sent successfully! Please check your phone.', 'success');
                    document.getElementById('otp-section').classList.remove('hidden');
                    document.getElementById('phone').setAttribute('readonly', 'readonly');
                    startOtpTimer(60); // 60 seconds timer
                } else {
                    showOtpMessage(data.message || 'Failed to send OTP. Please try again.', 'error');
                    this.disabled = false;
                    this.textContent = 'Send OTP';
                    this.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showOtpMessage('An error occurred. Please try again.', 'error');
                this.disabled = false;
                this.textContent = 'Send OTP';
                this.classList.remove('opacity-50', 'cursor-not-allowed');
            });
        });

        // Verify OTP
        document.getElementById('verify-otp-btn').addEventListener('click', function() {
            const phoneInput = document.getElementById('phone');
            const otpInput = document.getElementById('otp');
            const phone = phoneInput.value.trim();
            const otp = otpInput.value.trim();

            if (!otp || otp.length !== 6) {
                showOtpMessage('Please enter a valid 6-digit OTP', 'error');
                return;
            }

            // Disable button and show loading
            this.disabled = true;
            this.textContent = 'Verifying...';
            this.classList.add('opacity-50', 'cursor-not-allowed');

            // Verify OTP request
            fetch('{{ route("customer.verify-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ phone: phone, otp: otp })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showOtpMessage('Phone number verified successfully!', 'success');
                    document.getElementById('otp-section').classList.add('hidden');
                    document.getElementById('phone-verified-section').classList.remove('hidden');
                    document.getElementById('otp').setAttribute('readonly', 'readonly');
                    this.disabled = true;
                    this.textContent = 'Verified';
                    this.classList.add('bg-green-600');
                    clearOtpTimer();
                } else {
                    showOtpMessage(data.message || 'Invalid OTP. Please try again.', 'error');
                    if (data.attempts_remaining !== undefined) {
                        showOtpMessage(`Invalid OTP. ${data.attempts_remaining} attempts remaining.`, 'error');
                    }
                    this.disabled = false;
                    this.textContent = 'Verify OTP';
                    this.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showOtpMessage('An error occurred. Please try again.', 'error');
                this.disabled = false;
                this.textContent = 'Verify OTP';
                this.classList.remove('opacity-50', 'cursor-not-allowed');
            });
        });

        // Resend OTP
        document.getElementById('resend-otp-btn').addEventListener('click', function() {
            document.getElementById('send-otp-btn').click();
        });

        // OTP input - only numbers
        document.getElementById('otp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Show OTP message
        function showOtpMessage(message, type) {
            const messageDiv = document.getElementById('otp-message');
            messageDiv.textContent = message;
            messageDiv.className = 'mt-2 text-sm ' + (type === 'success' ? 'text-green-600' : 'text-red-600');
        }

        // Start OTP timer
        function startOtpTimer(seconds) {
            otpTimerSeconds = seconds;
            const timerElement = document.getElementById('otp-timer');
            const resendBtn = document.getElementById('resend-otp-btn');

            otpTimer = setInterval(function() {
                otpTimerSeconds--;
                const minutes = Math.floor(otpTimerSeconds / 60);
                const secs = otpTimerSeconds % 60;
                timerElement.textContent = `Resend OTP in ${minutes}:${secs.toString().padStart(2, '0')}`;

                if (otpTimerSeconds <= 0) {
                    clearOtpTimer();
                    timerElement.textContent = '';
                    resendBtn.classList.remove('hidden');
                }
            }, 1000);
        }

        // Clear OTP timer
        function clearOtpTimer() {
            if (otpTimer) {
                clearInterval(otpTimer);
                otpTimer = null;
            }
        }

        // Form submission - check if phone is verified
        document.getElementById('register-form').addEventListener('submit', function(e) {
            if (!document.getElementById('phone-verified-section').classList.contains('hidden')) {
                return true; // Phone is verified, allow submission
            }

            e.preventDefault();
            showOtpMessage('Please verify your phone number before submitting.', 'error');
            document.getElementById('otp-section').scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    </script>
</body>
</html>

