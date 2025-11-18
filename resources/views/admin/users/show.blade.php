@extends('admin.layout')

@section('title', 'User Details')
@section('page-title', 'User Details: ' . $user->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Users</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-4">User Information</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="text-sm text-gray-900">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="text-sm text-gray-900">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Admin Status</dt>
                    <dd class="text-sm">
                        @if($user->is_admin)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                Admin
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Customer
                            </span>
                        @endif
                    </dd>
                </div>
                @if($user->roles->count() > 0)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Assigned Roles</dt>
                        <dd class="text-sm mt-1">
                            @foreach($user->roles as $role)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 mr-1 mb-1">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </dd>
                    </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500">Account Created</dt>
                    <dd class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="text-sm text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Statistics</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Subscriptions</dt>
                    <dd class="text-sm text-gray-900">{{ $user->subscriptions->count() }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Completed Subscriptions</dt>
                    <dd class="text-sm text-gray-900">{{ $user->subscriptions->where('status', 'completed')->count() }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Pending Subscriptions</dt>
                    <dd class="text-sm text-gray-900">{{ $user->subscriptions->where('status', 'pending')->count() }}</dd>
                </div>
            </dl>
        </div>
    </div>

    @if($user->roles->count() > 0)
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold mb-4">User Roles & Permissions</h3>
            <div class="space-y-4">
                @foreach($user->roles as $role)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $role->name }}</h4>
                                @if($role->description)
                                    <p class="text-sm text-gray-600 mt-1">{{ $role->description }}</p>
                                @endif
                            </div>
                            <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-full">
                                {{ $role->permissions->count() }} permission(s)
                            </span>
                        </div>
                        @if($role->permissions->count() > 0)
                            <div class="mt-3">
                                <p class="text-xs font-medium text-gray-700 mb-2">Permissions:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($role->permissions->groupBy('group') as $group => $permissions)
                                        @if($group)
                                            <div class="w-full mb-2">
                                                <span class="text-xs font-semibold text-gray-600 uppercase">{{ $group }}:</span>
                                                <div class="flex flex-wrap gap-2 mt-1">
                                                    @foreach($permissions as $permission)
                                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded" title="{{ $permission->description ?? '' }}">
                                                            {{ $permission->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            @foreach($permissions as $permission)
                                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded" title="{{ $permission->description ?? '' }}">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No permissions assigned to this role</p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-700">
                    <strong>Total Permissions:</strong> {{ $user->roles->pluck('permissions')->flatten()->unique('id')->count() }} unique permission(s) across all roles
                </p>
            </div>
        </div>
    @else
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-sm text-yellow-800">
                    <strong>No roles assigned.</strong> This user has no roles or permissions assigned. Assign roles to grant permissions.
                </p>
            </div>
        </div>
    @endif

    @if($user->subscriptions->count() > 0)
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Subscriptions</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($user->subscriptions as $subscription)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $subscription->plan->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($subscription->amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($subscription->status === 'completed') bg-green-100 text-green-800
                                        @elseif($subscription->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($subscription->status === 'failed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($subscription->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $subscription->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="text-lg font-semibold mb-4">Assign Roles</h3>
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="flex items-center space-x-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="name" value="{{ $user->name }}">
            <input type="hidden" name="email" value="{{ $user->email }}">
            <input type="hidden" name="is_admin" value="{{ $user->is_admin ? 1 : 0 }}">
            
            <select name="roles[]" multiple class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 min-w-[200px]">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Update Roles
            </button>
        </form>
        <p class="text-xs text-gray-500 mt-2">Hold Ctrl/Cmd to select multiple roles</p>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Edit User
        </a>
    </div>
</div>
@endsection

