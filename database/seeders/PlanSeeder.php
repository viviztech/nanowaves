<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'All TV Channels',
                'description' => 'Complete TV entertainment',
                'price' => 170.00,
                'billing_period' => 'monthly',
                'features' => [
                    '170+ TV Channels',
                    'HD Quality Channels',
                    'All genres included',
                ],
                'speed' => null,
                'is_popular' => false,
                'is_active' => true,
                'plan_type' => 'tv',
            ],
            [
                'name' => 'TV + Internet',
                'description' => 'Perfect starter bundle',
                'price' => 399.00,
                'billing_period' => 'monthly',
                'features' => [
                    'All TV Channels',
                    '30 Mbps Internet Speed',
                    'Unlimited data',
                ],
                'speed' => '30 Mbps',
                'is_popular' => false,
                'is_active' => true,
                'plan_type' => 'bundle',
            ],
            [
                'name' => 'TV + OTT + Internet',
                'description' => 'Best value bundle',
                'price' => 549.00,
                'billing_period' => 'monthly',
                'features' => [
                    'All TV Channels',
                    'OTT Content Access',
                    '50 Mbps Internet Speed',
                    'Unlimited data',
                ],
                'speed' => '50 Mbps',
                'is_popular' => true,
                'is_active' => true,
                'plan_type' => 'bundle',
            ],
            [
                'name' => 'TV + OTT + WiFi',
                'description' => 'High-speed bundle',
                'price' => 799.00,
                'billing_period' => 'monthly',
                'features' => [
                    'All TV Channels',
                    'OTT Content Access',
                    'WiFi Internet 100 Mbps',
                    'Unlimited data',
                ],
                'speed' => '100 Mbps',
                'is_popular' => false,
                'is_active' => true,
                'plan_type' => 'bundle',
            ],
            [
                'name' => 'Premium Bundle',
                'description' => 'Ultimate entertainment',
                'price' => 899.00,
                'billing_period' => 'monthly',
                'features' => [
                    'All TV Channels',
                    'OTT Content Access',
                    'Movies Channel',
                    'WiFi Internet 100 Mbps',
                    'Unlimited data',
                ],
                'speed' => '100 Mbps',
                'is_popular' => false,
                'is_active' => true,
                'plan_type' => 'bundle',
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
