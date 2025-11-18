<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Services\Msg91Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CustomerAuthController extends Controller
{
    /**
     * Show the customer login form
     */
    public function showLoginForm()
    {
        if (auth()->check() && !auth()->user()->is_admin) {
            return redirect()->route('customer.dashboard');
        }
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('customer.login');
    }

    /**
     * Handle customer login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, ' . Auth::user()->name . '!');
            } else {
                return redirect()->intended(route('customer.dashboard'))
                    ->with('success', 'Welcome back, ' . Auth::user()->name . '!');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the customer registration form
     */
    public function showRegisterForm(Request $request)
    {
        if (auth()->check() && !auth()->user()->is_admin) {
            return redirect()->route('customer.dashboard');
        }
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // Get all active plans
        $plans = Plan::where('is_active', true)
            ->orderBy('price')
            ->get();

        // Get selected plan if provided
        $selectedPlanId = $request->get('plan');

        return view('customer.register', compact('plans', 'selectedPlanId'));
    }

    /**
     * Send OTP to mobile number
     */
    public function sendOTP(Request $request, Msg91Service $msg91Service)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $result = $msg91Service->sendOTP($validated['phone']);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message'],
        ], 400);
    }

    /**
     * Verify OTP
     */
    public function verifyOTP(Request $request, Msg91Service $msg91Service)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'otp' => 'required|string|size:6',
        ]);

        $result = $msg91Service->verifyOTP($validated['phone'], $validated['otp']);

        if ($result['success']) {
            // Normalize phone number for session storage
            $phone = preg_replace('/[^0-9]/', '', $validated['phone']);
            if (strlen($phone) == 10) {
                $phone = '91' . $phone;
            }
            // Store verification in session
            $request->session()->put('phone_verified', $phone);
            
            return response()->json([
                'success' => true,
                'message' => $result['message'],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message'],
            'attempts_remaining' => $result['attempts_remaining'] ?? null,
        ], 400);
    }

    /**
     * Handle customer registration
     */
    public function register(Request $request, Msg91Service $msg91Service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => 'required|string|max:20',
            'plan_id' => 'nullable|exists:plans,id',
        ]);

        // Verify phone number
        $phone = preg_replace('/[^0-9]/', '', $validated['phone']);
        if (strlen($phone) == 10) {
            $phone = '91' . $phone;
        }

        if (!$msg91Service->isPhoneVerified($validated['phone'])) {
            return back()
                ->withInput()
                ->withErrors(['phone' => 'Please verify your phone number with OTP before registering.']);
        }

        // Verify session phone matches submitted phone
        $sessionPhone = $request->session()->get('phone_verified');
        $submittedPhone = preg_replace('/[^0-9]/', '', $validated['phone']);
        if (strlen($submittedPhone) == 10) {
            $submittedPhone = '91' . $submittedPhone;
        }

        if ($sessionPhone !== $submittedPhone) {
            return back()
                ->withInput()
                ->withErrors(['phone' => 'Phone number verification mismatch. Please verify again.']);
        }

        // Create user account
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        // Clear phone verification from session
        $request->session()->forget('phone_verified');

        // Log the user in
        Auth::login($user);

        $request->session()->regenerate();

        // If a plan was selected, redirect to checkout
        if ($request->filled('plan_id')) {
            $plan = Plan::findOrFail($request->plan_id);
            return redirect()->route('checkout', ['plan' => $plan])
                ->with('success', 'Account created successfully! Please complete your subscription.');
        }

        // Otherwise redirect to plans page
        return redirect()->route('plans.index')
            ->with('success', 'Account created successfully! Please select a plan to get started.');
    }

    /**
     * Handle customer logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login')->with('success', 'You have been logged out successfully.');
    }
}
