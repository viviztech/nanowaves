<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role !== '') {
            if ($request->role === 'admin') {
                // Filter by is_admin flag
                $query->where('is_admin', true);
            } elseif ($request->role === 'no-role') {
                // Users with no roles assigned
                $query->doesntHave('roles')->where('is_admin', false);
            } else {
                // Filter by specific role ID
                $query->whereHas('roles', function($q) use ($request) {
                    $q->where('roles.id', $request->role);
                });
            }
        }

        $users = $query->with(['roles.permissions'])->withCount('subscriptions')->latest()->paginate(20);
        $roles = Role::where('is_active', true)->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check permission
        if (!auth()->user()->hasPermission('users.create') && !auth()->user()->is_admin) {
            abort(403, 'You do not have permission to create users.');
        }

        $roles = Role::where('is_active', true)->with('permissions')->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check permission
        if (!auth()->user()->hasPermission('users.create') && !auth()->user()->is_admin) {
            abort(403, 'You do not have permission to create users.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = $request->has('is_admin');

        $user = User::create($validated);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Check permission
        if (!auth()->user()->hasPermission('users.view') && !auth()->user()->is_admin) {
            abort(403, 'You do not have permission to view users.');
        }

        $user->load(['subscriptions.plan', 'roles.permissions']);
        $roles = Role::where('is_active', true)->with('permissions')->get();
        return view('admin.users.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Check permission
        if (!auth()->user()->hasPermission('users.edit') && !auth()->user()->is_admin) {
            abort(403, 'You do not have permission to edit users.');
        }

        $roles = Role::where('is_active', true)->with('permissions')->get();
        $user->load('roles.permissions');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Check permission
        if (!auth()->user()->hasPermission('users.edit') && !auth()->user()->is_admin) {
            abort(403, 'You do not have permission to edit users.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id), 'max:255'],
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_admin'] = $request->has('is_admin');

        $user->update($validated);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->detach();
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Check permission
        if (!auth()->user()->hasPermission('users.delete') && !auth()->user()->is_admin) {
            abort(403, 'You do not have permission to delete users.');
        }

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Prevent deleting if user has subscriptions
        if ($user->subscriptions()->exists()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete user with active subscriptions.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
