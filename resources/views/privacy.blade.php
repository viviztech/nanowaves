@extends('layouts.app')

@section('title', 'Privacy Policy - NanoWaves')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Privacy Policy</h1>
            <p class="text-xl text-blue-100">Last updated: {{ date('F d, Y') }}</p>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Introduction</h2>
            <p class="text-gray-700 mb-6">
                NanoWaves ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our services and website.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Information We Collect</h2>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Personal Information</h3>
            <p class="text-gray-700 mb-4">We may collect the following personal information:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>Name, email address, phone number, and postal address</li>
                <li>Payment information (credit/debit card details, billing address)</li>
                <li>Account credentials and authentication information</li>
                <li>Service usage data and connection logs</li>
                <li>Device information and IP addresses</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-800 mb-3">Automatically Collected Information</h3>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>Browser type and version</li>
                <li>Operating system</li>
                <li>Pages visited and time spent on pages</li>
                <li>Referring website addresses</li>
                <li>Network usage statistics</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. How We Use Your Information</h2>
            <p class="text-gray-700 mb-4">We use the collected information for the following purposes:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li>To provide, maintain, and improve our services</li>
                <li>To process payments and manage your account</li>
                <li>To communicate with you about your account and services</li>
                <li>To send promotional materials and updates (with your consent)</li>
                <li>To detect and prevent fraud or abuse</li>
                <li>To comply with legal obligations</li>
                <li>To analyze usage patterns and improve user experience</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Information Sharing and Disclosure</h2>
            <p class="text-gray-700 mb-4">We do not sell your personal information. We may share your information in the following circumstances:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li><strong>Service Providers:</strong> With third-party service providers who assist in operating our services</li>
                <li><strong>Legal Requirements:</strong> When required by law or to protect our rights</li>
                <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
                <li><strong>With Your Consent:</strong> When you explicitly authorize us to share your information</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Data Security</h2>
            <p class="text-gray-700 mb-6">
                We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Data Retention</h2>
            <p class="text-gray-700 mb-6">
                We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law. When we no longer need your information, we will securely delete or anonymize it.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Your Rights</h2>
            <p class="text-gray-700 mb-4">You have the following rights regarding your personal information:</p>
            <ul class="list-disc pl-6 text-gray-700 mb-6 space-y-2">
                <li><strong>Access:</strong> Request access to your personal information</li>
                <li><strong>Correction:</strong> Request correction of inaccurate information</li>
                <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                <li><strong>Objection:</strong> Object to processing of your personal information</li>
                <li><strong>Data Portability:</strong> Request transfer of your data to another service provider</li>
                <li><strong>Withdraw Consent:</strong> Withdraw consent for data processing where applicable</li>
            </ul>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Cookies and Tracking Technologies</h2>
            <p class="text-gray-700 mb-6">
                We use cookies and similar tracking technologies to enhance your experience, analyze usage patterns, and improve our services. You can control cookie preferences through your browser settings, though this may affect website functionality.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Third-Party Links</h2>
            <p class="text-gray-700 mb-6">
                Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites. We encourage you to review their privacy policies before providing any personal information.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Children's Privacy</h2>
            <p class="text-gray-700 mb-6">
                Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you believe we have collected information from a child, please contact us immediately.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Changes to This Privacy Policy</h2>
            <p class="text-gray-700 mb-6">
                We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the new policy on this page and updating the "Last updated" date. Your continued use of our services after changes constitutes acceptance of the updated policy.
            </p>

            <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Contact Us</h2>
            <p class="text-gray-700 mb-4">
                If you have any questions or concerns about this Privacy Policy or our data practices, please contact us:
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

