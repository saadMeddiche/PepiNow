<?php

namespace App\Policies;

use App\Models\Categorie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Show-Categories') || $user->hasPermissionTo('*');
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo('Show-Categorie') || $user->hasPermissionTo('*');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('Add-Categorie') || $user->hasPermissionTo('*');
    }

    public function update(User $user, Categorie $categorie)
    {
        return $user->hasPermissionTo('Update-Categorie') || $user->hasPermissionTo('*');
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo('Delete-Categorie') || $user->hasPermissionTo('*');

    }

}
