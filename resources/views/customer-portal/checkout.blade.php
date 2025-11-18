@extends('layouts.app')

@section('title', 'Checkout - NanoWaves')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Complete Your Subscription</h1>
            <p class="text-gray-600">Fill in your details and proceed to payment</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Plan Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4 text-gray-900">Order Summary</h2>
                    <div class="border-b border-gray-200 pb-4 mb-4">
                        <h3 class="font-semibold text-gray-900">{{ $plan->name }}</h3>
                        @if($plan->description)
                            <p class="text-sm text-gray-600 mt-1">{{ $plan->description }}</p>
                        @endif
                    </div>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Plan Price</span>
                            <span class="font-semibold">₹{{ number_format($plan->price, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Billing Period</span>
                            <span class="font-semibold capitalize">{{ $plan->billing_period }}</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-blue-600">₹{{ number_format($plan->price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                    <h2 class="text-xl font-bold mb-6 text-gray-900">Customer Information</h2>
                    
                    <form id="checkout-form">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="customer_name" name="customer_name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="customer_email" name="customer_email" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="customer_phone" name="customer_phone" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address <span class="text-red-500">*</span>
                                </label>
                                <textarea id="customer_address" name="customer_address" rows="3" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                        City <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="city" name="city" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700 mb-2">
                                        State <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="state" name="state" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="pincode" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pincode <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="pincode" name="pincode" required maxlength="10"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                        Country <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="country" name="country" required value="India"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>

                            <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"></div>

                            <button type="submit" id="pay-button" 
                                class="w-full bg-blue-600 text-white py-4 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl text-lg">
                                Proceed to Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Checkout Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

@push('scripts')
<script>
document.getElementById('checkout-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const payButton = document.getElementById('pay-button');
    const errorMessage = document.getElementById('error-message');
    
    // Disable button
    payButton.disabled = true;
    payButton.textContent = 'Processing...';
    errorMessage.classList.add('hidden');
    
    try {
        // Create order
        const response = await fetch('{{ route("payment.create-order", $plan->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token'),
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.message || 'Failed to create order');
        }
        
        // Initialize Razorpay
        const options = {
            key: data.key_id,
            amount: data.amount,
            currency: data.currency,
            name: 'NanoWaves',
            description: '{{ $plan->name }} Subscription',
            order_id: data.order_id,
            handler: function(response) {
                // Create form to submit payment details
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("payment.success") }}';
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = formData.get('_token');
                form.appendChild(csrfInput);
                
                const orderIdInput = document.createElement('input');
                orderIdInput.type = 'hidden';
                orderIdInput.name = 'razorpay_order_id';
                orderIdInput.value = response.razorpay_order_id;
                form.appendChild(orderIdInput);
                
                const paymentIdInput = document.createElement('input');
                paymentIdInput.type = 'hidden';
                paymentIdInput.name = 'razorpay_payment_id';
                paymentIdInput.value = response.razorpay_payment_id;
                form.appendChild(paymentIdInput);
                
                const signatureInput = document.createElement('input');
                signatureInput.type = 'hidden';
                signatureInput.name = 'razorpay_signature';
                signatureInput.value = response.razorpay_signature;
                form.appendChild(signatureInput);
                
                const subscriptionInput = document.createElement('input');
                subscriptionInput.type = 'hidden';
                subscriptionInput.name = 'subscription_id';
                subscriptionInput.value = data.subscription_id;
                form.appendChild(subscriptionInput);
                
                document.body.appendChild(form);
                form.submit();
            },
            prefill: {
                name: formData.get('customer_name'),
                email: formData.get('customer_email'),
                contact: formData.get('customer_phone'),
            },
            theme: {
                color: '#2563eb'
            },
            modal: {
                ondismiss: function() {
                    payButton.disabled = false;
                    payButton.textContent = 'Proceed to Payment';
                }
            }
        };
        
        const razorpay = new Razorpay(options);
        razorpay.open();
        
    } catch (error) {
        errorMessage.textContent = error.message || 'An error occurred. Please try again.';
        errorMessage.classList.remove('hidden');
        payButton.disabled = false;
        payButton.textContent = 'Proceed to Payment';
    }
});
</script>
@endpush
@endsection

