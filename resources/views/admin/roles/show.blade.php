@extends('admin.layout')

@section('title', 'Role Details')
@section('page-title', 'Role Details: ' . $role->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <a href="{{ route('admin.roles.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Roles</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <h3 class="text-lg font-semibold mb-4">Role Information</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="text-sm text-gray-900">{{ $role->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="text-sm text-gray-900">{{ $role->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="text-sm text-gray-900">{{ $role->description ?? 'No description' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $role->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $role->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Statistics</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Users</dt>
                    <dd class="text-sm text-gray-900">{{ $role->users->count() }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Permissions</dt>
                    <dd class="text-sm text-gray-900">{{ $role->permissions->count() }}</dd>
                </div>
            </dl>
        </div>
    </div>

    @if($role->permissions->count() > 0)
        <div class="mb-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Assigned Permissions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($role->permissions->groupBy('group') as $group => $groupPermissions)
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-2">{{ $group ?? 'General' }}</h4>
                        <ul class="space-y-1">
                            @foreach($groupPermissions as $permission)
                                <li class="text-sm text-gray-700">• {{ $permission->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($role->users->count() > 0)
        <div class="pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Users with this Role</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($role->users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-6 flex justify-end space-x-4">
        <a href="{{ route('admin.roles.edit', $role) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Edit Role
        </a>
    </div>
</div>
@endsection

