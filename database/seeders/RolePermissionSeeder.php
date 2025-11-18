<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // Plans Permissions
            ['name' => 'View Plans', 'slug' => 'plans.view', 'group' => 'plans', 'description' => 'View all plans'],
            ['name' => 'Create Plans', 'slug' => 'plans.create', 'group' => 'plans', 'description' => 'Create new plans'],
            ['name' => 'Edit Plans', 'slug' => 'plans.edit', 'group' => 'plans', 'description' => 'Edit existing plans'],
            ['name' => 'Delete Plans', 'slug' => 'plans.delete', 'group' => 'plans', 'description' => 'Delete plans'],
            
            // Users Permissions
            ['name' => 'View Users', 'slug' => 'users.view', 'group' => 'users', 'description' => 'View all users'],
            ['name' => 'Create Users', 'slug' => 'users.create', 'group' => 'users', 'description' => 'Create new users'],
            ['name' => 'Edit Users', 'slug' => 'users.edit', 'group' => 'users', 'description' => 'Edit user details'],
            ['name' => 'Delete Users', 'slug' => 'users.delete', 'group' => 'users', 'description' => 'Delete users'],
            
            // Subscriptions Permissions
            ['name' => 'View Subscriptions', 'slug' => 'subscriptions.view', 'group' => 'subscriptions', 'description' => 'View all subscriptions'],
            ['name' => 'Manage Subscriptions', 'slug' => 'subscriptions.manage', 'group' => 'subscriptions', 'description' => 'Update subscription status'],
            ['name' => 'Delete Subscriptions', 'slug' => 'subscriptions.delete', 'group' => 'subscriptions', 'description' => 'Delete subscriptions'],
            
            // Roles & Permissions
            ['name' => 'View Roles', 'slug' => 'roles.view', 'group' => 'roles', 'description' => 'View all roles'],
            ['name' => 'Create Roles', 'slug' => 'roles.create', 'group' => 'roles', 'description' => 'Create new roles'],
            ['name' => 'Edit Roles', 'slug' => 'roles.edit', 'group' => 'roles', 'description' => 'Edit roles'],
            ['name' => 'Delete Roles', 'slug' => 'roles.delete', 'group' => 'roles', 'description' => 'Delete roles'],
            ['name' => 'View Permissions', 'slug' => 'permissions.view', 'group' => 'permissions', 'description' => 'View all permissions'],
            ['name' => 'Create Permissions', 'slug' => 'permissions.create', 'group' => 'permissions', 'description' => 'Create new permissions'],
            ['name' => 'Edit Permissions', 'slug' => 'permissions.edit', 'group' => 'permissions', 'description' => 'Edit permissions'],
            ['name' => 'Delete Permissions', 'slug' => 'permissions.delete', 'group' => 'permissions', 'description' => 'Delete permissions'],
            
            // Dashboard
            ['name' => 'View Dashboard', 'slug' => 'dashboard.view', 'group' => 'dashboard', 'description' => 'Access admin dashboard'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }

        // Create Roles
        $superAdminRole = Role::firstOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => 'Super Admin',
                'description' => 'Full access to all features',
                'is_active' => true,
            ]
        );

        $managerRole = Role::firstOrCreate(
            ['slug' => 'manager'],
            [
                'name' => 'Manager',
                'description' => 'Can manage plans, subscriptions, and users',
                'is_active' => true,
            ]
        );

        $supportRole = Role::firstOrCreate(
            ['slug' => 'support'],
            [
                'name' => 'Support Staff',
                'description' => 'Can view and manage subscriptions',
                'is_active' => true,
            ]
        );

        // Assign all permissions to Super Admin
        $superAdminRole->permissions()->sync(Permission::pluck('id'));

        // Assign permissions to Manager
        $managerPermissions = Permission::whereIn('slug', [
            'dashboard.view',
            'plans.view', 'plans.create', 'plans.edit', 'plans.delete',
            'users.view', 'users.create', 'users.edit',
            'subscriptions.view', 'subscriptions.manage',
        ])->pluck('id');
        $managerRole->permissions()->sync($managerPermissions);

        // Assign permissions to Support
        $supportPermissions = Permission::whereIn('slug', [
            'dashboard.view',
            'plans.view',
            'users.view',
            'subscriptions.view', 'subscriptions.manage',
        ])->pluck('id');
        $supportRole->permissions()->sync($supportPermissions);
    }
}
