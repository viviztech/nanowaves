@extends('admin.layout')

@section('title', 'Permission Details')
@section('page-title', 'Permission Details: ' . $permission->name)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <a href="{{ route('admin.permissions.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Permissions</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <h3 class="text-lg font-semibold mb-4">Permission Information</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="text-sm text-gray-900">{{ $permission->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="text-sm text-gray-900">{{ $permission->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Group</dt>
                    <dd class="text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $permission->group ?? 'General' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="text-sm text-gray-900">{{ $permission->description ?? 'No description' }}</dd>
                </div>
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Statistics</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Roles</dt>
                    <dd class="text-sm text-gray-900">{{ $permission->roles->count() }}</dd>
                </div>
            </dl>
        </div>
    </div>

    @if($permission->roles->count() > 0)
        <div class="pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Roles with this Permission</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($permission->roles as $role)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $role->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $role->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $role->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.roles.show', $role) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="mt-6 flex justify-end space-x-4">
        <a href="{{ route('admin.permissions.edit', $permission) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Edit Permission
        </a>
    </div>
</div>
@endsection

