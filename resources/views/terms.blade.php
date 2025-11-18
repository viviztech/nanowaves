@extends('layouts.app')

@section('title', 'Terms & Conditions - NanoWaves')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Terms & Conditions</h1>
            <p class="text-xl text-blue-100">Last updated: {{ date('F d, Y') }}</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Acceptance of Terms</h2>
            <p class="text-gray-700 mb-6">
                By accessing and using NanoWaves services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to these Terms & Conditions, please do not use our services.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Service Description</h2>
            <p class="text-gray-700 mb-6">
                NanoWaves provides internet connectivity services, including but not limited to broadband internet, fiber-optic connections, and related telecommunications services. We reserve the right to modify, suspend, or discontinue any aspect of our services at any time.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. User Responsibilities</h2>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>You are responsible for maintaining the confidentiality of your account credentials</li>
                <li>You agree to use our services only for lawful purposes</li>
                <li>You will not use our services to transmit any harmful, offensive, or illegal content</li>
                <li>You are responsible for all activities that occur under your account</li>
                <li>You must provide accurate and complete information during registration</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Payment Terms</h2>
            <p class="text-gray-700 mb-4">
                All fees for services are due in advance as per the billing cycle selected. Payment can be made through various methods including credit/debit cards, net banking, and UPI.
            </p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>Late payments may result in service suspension or termination</li>
                <li>All fees are non-refundable unless otherwise stated</li>
                <li>We reserve the right to change our pricing with 30 days notice</li>
                <li>Refunds, if applicable, will be processed within 7-14 business days</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Service Availability</h2>
            <p class="text-gray-700 mb-6">
                While we strive to provide uninterrupted service, we do not guarantee 100% uptime. Service may be interrupted due to maintenance, upgrades, or circumstances beyond our control. We are not liable for any losses incurred during service interruptions.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Data Usage and Fair Usage Policy</h2>
            <p class="text-gray-700 mb-6">
                Our services are subject to fair usage policies. Excessive usage that affects network performance may result in speed throttling or service restrictions. We reserve the right to monitor usage patterns and take appropriate action.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Intellectual Property</h2>
            <p class="text-gray-700 mb-6">
                All content, trademarks, logos, and intellectual property on our website and services are the property of NanoWaves or its licensors. You may not use, reproduce, or distribute any content without our written permission.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Limitation of Liability</h2>
            <p class="text-gray-700 mb-6">
                NanoWaves shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including loss of profits, data, or business opportunities, arising from the use or inability to use our services.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Termination</h2>
            <p class="text-gray-700 mb-6">
                Either party may terminate the service agreement with 30 days written notice. We reserve the right to terminate services immediately for violation of these terms, non-payment, or illegal activities.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Changes to Terms</h2>
            <p class="text-gray-700 mb-6">
                We reserve the right to modify these Terms & Conditions at any time. Changes will be effective immediately upon posting on our website. Continued use of our services after changes constitutes acceptance of the new terms.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Governing Law</h2>
            <p class="text-gray-700 mb-6">
                These Terms & Conditions shall be governed by and construed in accordance with the laws of India. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts in Karur, Tamil Nadu.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Contact Information</h2>
            <p class="text-gray-700 mb-4">
                For any questions regarding these Terms & Conditions, please contact us:
            </p>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-700"><strong>Email:</strong> <a href="mailto:support@nanowaves.net" class="text-blue-600 hover:underline">support@nanowaves.net</a></p>
                <p class="text-gray-700"><strong>Phone:</strong> <a href="tel:7050050072" class="text-blue-600 hover:underline">70500 50072</a></p>
                <p class="text-gray-700"><strong>Address:</strong> 476/A Sakthimurugan Complex, Velliyanai North, Karur - 639118</p>
            </div>
        </div>
    </div>
</section>
@endsection

