# Role and Permission Management System

This document explains how to use the role and permission management system in the NanoWaves admin panel.

## Overview

The system provides a flexible way to manage user access through roles and permissions:
- **Roles**: Collections of permissions that can be assigned to users
- **Permissions**: Specific actions that can be performed (e.g., "View Plans", "Edit Users")
- **Users**: Can have multiple roles, and roles can have multiple permissions

## Database Structure

### Tables Created
- `roles` - Stores role information
- `permissions` - Stores permission information
- `role_permission` - Pivot table linking roles to permissions
- `user_role` - Pivot table linking users to roles

## Default Setup

After running migrations and seeders, you'll have:

### Default Permissions (20 permissions)
- **Plans**: View, Create, Edit, Delete
- **Users**: View, Create, Edit, Delete
- **Subscriptions**: View, Manage, Delete
- **Roles & Permissions**: View, Create, Edit, Delete (for both)
- **Dashboard**: View Dashboard

### Default Roles
1. **Super Admin** - Has all permissions
2. **Manager** - Can manage plans, users, and subscriptions (no role/permission management)
3. **Support Staff** - Can view plans/users and manage subscriptions

## Usage

### In Controllers

Check if a user has a permission:
```php
if (auth()->user()->hasPermission('edit-plans')) {
    // User can edit plans
}
```

Check if a user has a role:
```php
if (auth()->user()->hasRole('manager')) {
    // User has manager role
}
```

### In Blade Views

Check permissions:
```blade
@if(auth()->user()->hasPermission('delete-users'))
    <button>Delete User</button>
@endif
```

Check roles:
```blade
@if(auth()->user()->hasRole('super-admin'))
    <a href="/admin/settings">Settings</a>
@endif
```

### Assigning Roles to Users

In the admin panel:
1. Go to Users → Edit User
2. Select roles from the "Assign Roles" section
3. Save

Or programmatically:
```php
$user->assignRole('manager');
$user->syncRoles(['manager', 'support']);
$user->removeRole('support');
```

## Admin Panel Features

### Roles Management (`/admin/roles`)
- List all roles with user and permission counts
- Create new roles with permission assignments
- Edit existing roles and update permissions
- View role details including assigned users and permissions
- Delete roles (protected if assigned to users)

### Permissions Management (`/admin/permissions`)
- List all permissions grouped by category
- Create new permissions with groups
- Edit existing permissions
- View permission details including assigned roles
- Delete permissions (protected if assigned to roles)
- Filter by group

### User Management Updates
- Assign multiple roles to users
- View user roles and permissions
- See role-based permissions in user details

## Permission Checking Methods

### User Model Methods
- `hasRole($role)` - Check if user has a specific role
- `hasAnyRole(array $roles)` - Check if user has any of the roles
- `hasPermission($permission)` - Check if user has a permission (through roles or admin status)
- `hasAnyPermission(array $permissions)` - Check if user has any of the permissions
- `assignRole($role)` - Assign a role to user
- `removeRole($role)` - Remove a role from user
- `syncRoles(array $roles)` - Sync user roles

### Role Model Methods
- `hasPermission($permission)` - Check if role has a permission

## Important Notes

1. **Admin Users**: Users with `is_admin = true` automatically have all permissions, regardless of roles
2. **Multiple Roles**: Users can have multiple roles, and permissions are cumulative
3. **Role Deletion**: Roles cannot be deleted if assigned to users
4. **Permission Deletion**: Permissions cannot be deleted if assigned to roles

## Seeding Default Data

Run the seeder to create default roles and permissions:

```bash
php artisan db:seed --class=RolePermissionSeeder
```

Or run all seeders:

```bash
php artisan db:seed
```

## Example Workflow

1. **Create a Permission**:
   - Go to Permissions → Create Permission
   - Name: "Export Reports"
   - Group: "Reports"
   - Save

2. **Create a Role**:
   - Go to Roles → Create Role
   - Name: "Report Manager"
   - Assign "Export Reports" permission
   - Save

3. **Assign Role to User**:
   - Go to Users → Edit User
   - Select "Report Manager" role
   - Save

4. **Use in Code**:
   ```php
   if (auth()->user()->hasPermission('export-reports')) {
       // Allow export
   }
   ```

## Best Practices

1. Use permission slugs consistently (e.g., `view-plans`, `edit-users`)
2. Group related permissions together
3. Create roles that represent job functions
4. Test permission checks before deploying
5. Document custom permissions in your codebase

## Troubleshooting

### User can't access a feature
- Check if user has the required role
- Verify the role has the required permission
- Check if user is admin (admins bypass permission checks)

### Permission not working
- Verify permission slug matches exactly
- Check if role is assigned to user
- Ensure role has the permission assigned
- Clear cache: `php artisan cache:clear`

