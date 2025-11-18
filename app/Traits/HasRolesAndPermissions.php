<?php

namespace App\Traits;

trait HasRolesAndPermissions
{
    /**
     * Check if user has a specific role
     */
    public function hasRole($role): bool
    {
        if (is_string($role)) {
            return $this->roles()->where('slug', $role)->exists();
        }
        return $this->roles->contains($role);
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if user has all of the given roles
     */
    public function hasAllRoles(array $roles): bool
    {
        foreach ($roles as $role) {
            if (!$this->hasRole($role)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if user has a specific permission
     */
    public function hasPermission($permission): bool
    {
        // Admins have all permissions
        if ($this->is_admin) {
            return true;
        }

        // Check if user has permission through any of their roles
        foreach ($this->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has any of the given permissions
     */
    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Assign a role to the user
     */
    public function assignRole($role): void
    {
        if (is_string($role)) {
            $role = \App\Models\Role::where('slug', $role)->firstOrFail();
        }
        
        if (!$this->hasRole($role)) {
            $this->roles()->attach($role);
        }
    }

    /**
     * Remove a role from the user
     */
    public function removeRole($role): void
    {
        if (is_string($role)) {
            $role = \App\Models\Role::where('slug', $role)->firstOrFail();
        }
        
        $this->roles()->detach($role);
    }

    /**
     * Sync roles for the user
     */
    public function syncRoles(array $roles): void
    {
        $roleIds = [];
        foreach ($roles as $role) {
            if (is_string($role)) {
                $roleModel = \App\Models\Role::where('slug', $role)->first();
                if ($roleModel) {
                    $roleIds[] = $roleModel->id;
                }
            } else {
                $roleIds[] = $role;
            }
        }
        
        $this->roles()->sync($roleIds);
    }
}

