<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminPermissionController;

Route::get('/', function () {
    $allPlans = \App\Models\Plan::where('is_active', true)
        ->orderBy('price')
        ->get();
    
    // Group plans by type and get featured plans (limit to 3 per category)
    $homePlans = $allPlans->where('plan_type', 'home')->take(3)->values();
    $corporatePlans = $allPlans->where('plan_type', 'corporate')->take(3)->values();
    $ottPlans = $allPlans->where('plan_type', 'ott')->take(3)->values();
    
    // Handle legacy plan types: 'tv' and 'bundle' should go to OTT & IP TV Plans
    $legacyOttPlans = $allPlans->whereIn('plan_type', ['tv', 'bundle'])->take(3)->values();
    if ($legacyOttPlans->count() > 0) {
        $ottPlans = $ottPlans->merge($legacyOttPlans)->take(3)->sortBy('price')->values();
    }
    
    // If no plan_type is set or empty, default to home
    $untypedPlans = $allPlans->filter(function($plan) {
        return empty($plan->plan_type) || is_null($plan->plan_type);
    })->take(3)->values();
    
    // If there are untyped plans, assign them to home plans
    if ($untypedPlans->count() > 0) {
        if ($homePlans->count() == 0) {
            // If no home plans exist, use all untyped plans as home plans
            $homePlans = $untypedPlans->take(3)->sortBy('price')->values();
        } else {
            // Merge untyped plans with home plans if home plans count is less than 3
            $homePlans = $homePlans->merge($untypedPlans)->take(3)->sortBy('price')->values();
        }
    }
    
    // If still no plans in any category, show all plans in home plans
    if ($homePlans->count() == 0 && $corporatePlans->count() == 0 && $ottPlans->count() == 0) {
        $homePlans = $allPlans->take(3)->sortBy('price')->values();
    }
    
    return view('home', compact('homePlans', 'corporatePlans', 'ottPlans'));
})->name('home');

// Landing Page Routes
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Legal Pages
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/return-policy', function () {
    return view('return-policy');
})->name('return-policy');

// Customer Portal Routes
Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
Route::get('/plans/{plan}', [PlanController::class, 'show'])->name('plans.show');

// Payment Routes
Route::get('/checkout/{plan}', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/payment/create-order/{plan}', [PaymentController::class, 'createOrder'])->name('payment.create-order');
Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/success/{subscription}', [PaymentController::class, 'success'])->name('payment.success-page');
Route::get('/payment/failed', [PaymentController::class, 'paymentFailed'])->name('payment.failed');

// Customer Authentication Routes
Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// OTP Routes
Route::post('/customer/send-otp', [CustomerAuthController::class, 'sendOTP'])->name('customer.send-otp');
Route::post('/customer/verify-otp', [CustomerAuthController::class, 'verifyOTP'])->name('customer.verify-otp');

Route::get('/customer/dashboard', function() {
    return view('customer.dashboard');
})->middleware('auth')->name('customer.dashboard');

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Routes (Protected)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Plans Management
    Route::resource('plans', AdminPlanController::class);
    
    // Subscriptions Management
    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{subscription}', [AdminSubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::put('/subscriptions/{subscription}/status', [AdminSubscriptionController::class, 'updateStatus'])->name('subscriptions.update-status');
    Route::delete('/subscriptions/{subscription}', [AdminSubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
    
    // User Management
    Route::resource('users', AdminUserController::class);
    
    // Role Management
    Route::resource('roles', AdminRoleController::class);
    
    // Permission Management
    Route::resource('permissions', AdminPermissionController::class);
});
