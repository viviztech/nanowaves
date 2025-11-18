@extends('admin.layout')

@section('title', 'Create User')
@section('page-title', 'Create New User')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="md:col-span-2">
                <label class="flex items-center">
                    <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Grant Admin Access</span>
                </label>
            </div>

            @if($roles->count() > 0)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Assign Roles</label>
                    <div class="border border-gray-200 rounded-lg p-4 max-h-64 overflow-y-auto">
                        @foreach($roles as $role)
                            <label class="flex items-start mb-3 p-2 hover:bg-gray-50 rounded">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    class="mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <div class="ml-2 flex-1">
                                    <span class="text-sm font-medium text-gray-900">{{ $role->name }}</span>
                                    @if($role->description)
                                        <span class="block text-xs text-gray-500 mt-1">{{ $role->description }}</span>
                                    @endif
                                    @if($role->permissions->count() > 0)
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach($role->permissions->take(5) as $permission)
                                                <span class="px-2 py-0.5 text-xs bg-blue-50 text-blue-700 rounded">{{ $permission->name }}</span>
                                            @endforeach
                                            @if($role->permissions->count() > 5)
                                                <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded">+{{ $role->permissions->count() - 5 }} more</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Select roles to assign permissions to this user</p>
                </div>
            @endif
        </div>

        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Create User
            </button>
        </div>
    </form>
</div>
@endsection

