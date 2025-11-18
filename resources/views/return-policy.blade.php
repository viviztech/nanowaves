@extends('layouts.app')

@section('title', 'Return & Refund Policy - NanoWaves')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Return & Refund Policy</h1>
            <p class="text-xl text-blue-100">Last updated: {{ date('F d, Y') }}</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Overview</h2>
            <p class="text-gray-700 mb-6">
                This Return & Refund Policy outlines the terms and conditions for returns, refunds, and cancellations of NanoWaves services. Please read this policy carefully before subscribing to our services.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Service Cancellation</h2>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Cancellation by Customer</h3>
            <p class="text-gray-700 mb-4">You may cancel your service subscription at any time by:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>Calling our Customer Care at <a href="tel:7050050072" class="text-blue-600 hover:underline">70500 50072</a></li>
                <li>Emailing us at <a href="mailto:support@nanowaves.net" class="text-blue-600 hover:underline">support@nanowaves.net</a></li>
                <li>Visiting our office at 476/A Sakthimurugan Complex, Velliyanai North, Karur - 639118</li>
                <li>Through your customer portal account</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-800 mb-3">Cancellation by NanoWaves</h3>
            <p class="text-gray-700 mb-6">
                We reserve the right to cancel or suspend your service in cases of non-payment, violation of terms of service, illegal activities, or other circumstances as outlined in our Terms & Conditions.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. Refund Policy</h2>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Eligibility for Refunds</h3>
            <p class="text-gray-700 mb-4">Refunds may be considered in the following circumstances:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li><strong>Service Not Activated:</strong> If service is not activated within 7 days of payment, full refund will be processed</li>
                <li><strong>Technical Issues:</strong> If we are unable to provide service due to technical limitations in your area</li>
                <li><strong>Billing Errors:</strong> In case of duplicate charges or billing mistakes</li>
                <li><strong>Early Cancellation:</strong> Pro-rated refunds may be available for unused service periods (subject to terms)</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-800 mb-3">Non-Refundable Items</h3>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>Installation fees (unless service is not activated)</li>
                <li>Equipment charges (unless equipment is returned unused and in original condition)</li>
                <li>Service charges for periods where service was active and used</li>
                <li>Late payment fees and penalty charges</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Refund Processing</h2>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Processing Time</h3>
            <p class="text-gray-700 mb-4">
                Refund requests will be processed within 7-14 business days after approval. The refund will be credited to the original payment method used for the transaction.
            </p>

            <h3 class="text-xl font-semibold text-gray-800 mb-3">Refund Methods</h3>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>Credit/Debit Card: Refunded to the original card (5-7 business days)</li>
                <li>Net Banking/UPI: Refunded to the original account (3-5 business days)</li>
                <li>Bank Transfer: Processed via NEFT/RTGS (5-7 business days)</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Equipment Return Policy</h2>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Return Conditions</h3>
            <p class="text-gray-700 mb-4">Equipment (modems, routers, etc.) must be returned:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>Within 7 days of service cancellation</li>
                <li>In original packaging with all accessories</li>
                <li>In working condition without any damage</li>
                <li>With original purchase receipt or invoice</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-800 mb-3">Equipment Charges</h3>
            <p class="text-gray-700 mb-6">
                If equipment is not returned within the specified period or is damaged, appropriate charges will be deducted from your refund or billed separately.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Plan Changes and Upgrades</h2>
            <p class="text-gray-700 mb-4">
                You may upgrade or downgrade your plan at any time. Changes will be effective from the next billing cycle:
            </p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li><strong>Upgrades:</strong> Immediate activation with pro-rated charges</li>
                <li><strong>Downgrades:</strong> Effective from next billing cycle</li>
                <li>No refunds for the current billing period when downgrading</li>
                <li>Additional charges may apply for plan changes</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Service Interruptions</h2>
            <p class="text-gray-700 mb-6">
                In case of service interruptions lasting more than 24 hours due to our fault, you may be eligible for service credits or pro-rated refunds. Service interruptions due to maintenance, upgrades, or circumstances beyond our control are not eligible for refunds.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Dispute Resolution</h2>
            <p class="text-gray-700 mb-6">
                If you are not satisfied with our refund decision, you may contact our Customer Care team for review. All disputes will be resolved in accordance with our Terms & Conditions and applicable laws.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Changes to This Policy</h2>
            <p class="text-gray-700 mb-6">
                We reserve the right to modify this Return & Refund Policy at any time. Changes will be effective immediately upon posting on our website. Continued use of our services after changes constitutes acceptance of the updated policy.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Contact Information</h2>
            <p class="text-gray-700 mb-4">
                For refund requests, cancellations, or questions about this policy, please contact us:
            </p>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-700"><strong>Customer Care:</strong> <a href="tel:7050050072" class="text-blue-600 hover:underline">70500 50072</a></p>
                <p class="text-gray-700"><strong>Email:</strong> <a href="mailto:support@nanowaves.net" class="text-blue-600 hover:underline">support@nanowaves.net</a></p>
                <p class="text-gray-700"><strong>Billing Email:</strong> <a href="mailto:billing@nanowaves.net" class="text-blue-600 hover:underline">billing@nanowaves.net</a></p>
                <p class="text-gray-700"><strong>Address:</strong> 476/A Sakthimurugan Complex, Velliyanai North, Karur - 639118</p>
            </div>
        </div>
    </div>
</section>
@endsection

