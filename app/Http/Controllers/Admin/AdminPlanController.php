<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class AdminPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Plan::query();

        // Filter by plan type
        if ($request->has('plan_type') && $request->plan_type !== '') {
            if ($request->plan_type === 'legacy') {
                // Show legacy plans (tv, bundle, or null)
                $query->where(function($q) {
                    $q->whereIn('plan_type', ['tv', 'bundle'])
                      ->orWhereNull('plan_type');
                });
            } else {
                $query->where('plan_type', $request->plan_type);
            }
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $plans = $query->latest()->paginate(15);
        
        // Get counts for each plan type
        $planTypeCounts = [
            'all' => Plan::count(),
            'home' => Plan::where('plan_type', 'home')->count(),
            'corporate' => Plan::where('plan_type', 'corporate')->count(),
            'ott' => Plan::where('plan_type', 'ott')->count(),
            'legacy' => Plan::where(function($q) {
                $q->whereIn('plan_type', ['tv', 'bundle'])
                  ->orWhereNull('plan_type');
            })->count(),
        ];

        return view('admin.plans.index', compact('plans', 'planTypeCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly',
            'speed' => 'nullable|string|max:255',
            'plan_type' => 'nullable|in:home,corporate,ott,tv,bundle',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
        ]);

        $validated['features'] = $request->input('features', []);

        Plan::create($validated);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly',
            'speed' => 'nullable|string|max:255',
            'plan_type' => 'nullable|in:home,corporate,ott,tv,bundle',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
        ]);

        $validated['features'] = $request->input('features', []);
        $validated['is_popular'] = $request->has('is_popular');
        $validated['is_active'] = $request->has('is_active');

        $plan->update($validated);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        // Check if plan has active subscriptions
        if ($plan->subscriptions()->where('status', 'completed')->exists()) {
            return redirect()->route('admin.plans.index')
                ->with('error', 'Cannot delete plan with active subscriptions.');
        }

        $plan->delete();

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan deleted successfully.');
    }
}
