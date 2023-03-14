<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Show-Roles') || $user->hasPermissionTo('*');
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo('Show-Role')  || $user->hasPermissionTo('*');
    }


    public function create(User $user)
    {
        return $user->hasPermissionTo('Add-Role') || $user->hasPermissionTo('*');
    }


    public function update(User $user)
    {
        return $user->hasPermissionTo('Update-Role') || $user->hasPermissionTo('*');
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo('Delete-Role') || $user->hasPermissionTo('*');
    }

    public function assignPermissions(User $user)
    {
        return $user->hasPermissionTo('assignPermissions') || $user->hasPermissionTo('*');
    }

    public function assignRole(User $user)
    {
        return $user->hasPermissionTo('assignRole') || $user->hasPermissionTo('*');
    }

    public function RemovePermissions(User $user)
    {
        return $user->hasPermissionTo('RemovePermissions') || $user->hasPermissionTo('*');
    }

    public function RemoveRole(User $user)
    {
        return $user->hasPermissionTo('RemoveRole') || $user->hasPermissionTo('*');
    }

    public function ShowPermissionsOfaRole(User $user)
    {
        return $user->hasPermissionTo('ShowPermissionsOfaRole') || $user->hasPermissionTo('*');
    }
    public function ShowRolesOfaPermissions(User $user)
    {
        return $user->hasPermissionTo('ShowRolesOfaPermissions') || $user->hasPermissionTo('*');
    }
}
