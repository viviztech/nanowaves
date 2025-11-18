<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access the admin panel.');
        }

        $user = auth()->user();

        // Check if user is admin OR has an admin role
        if (!$user->is_admin && !$user->hasAnyRole(['admin', 'super-admin'])) {
            return redirect()->route('plans.index')->with('error', 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}
