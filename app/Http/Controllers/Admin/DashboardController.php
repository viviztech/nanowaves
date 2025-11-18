<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_plans' => Plan::count(),
            'active_plans' => Plan::where('is_active', true)->count(),
            'total_subscriptions' => Subscription::count(),
            'completed_subscriptions' => Subscription::where('status', 'completed')->count(),
            'pending_subscriptions' => Subscription::where('status', 'pending')->count(),
            'total_revenue' => Subscription::where('status', 'completed')->sum('amount'),
            'recent_subscriptions' => Subscription::with('plan')
                ->latest()
                ->take(10)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
