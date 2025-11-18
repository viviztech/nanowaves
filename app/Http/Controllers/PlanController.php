<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display the customer portal with all plans grouped by type
     */
    public function index()
    {
        $allPlans = Plan::where('is_active', true)
            ->orderBy('price')
            ->get();
        
        // Group plans by type
        $homePlans = $allPlans->where('plan_type', 'home')->values();
        $corporatePlans = $allPlans->where('plan_type', 'corporate')->values();
        $ottPlans = $allPlans->where('plan_type', 'ott')->values();
        
        // If no plan_type is set, default to home
        $untypedPlans = $allPlans->whereNull('plan_type')->values();
        if ($untypedPlans->count() > 0) {
            $homePlans = $homePlans->merge($untypedPlans)->sortBy('price')->values();
        }
        
        return view('customer-portal.plans', compact('homePlans', 'corporatePlans', 'ottPlans'));
    }

    /**
     * Show a specific plan details
     */
    public function show(Plan $plan)
    {
        return view('customer-portal.plan-details', compact('plan'));
    }
}
