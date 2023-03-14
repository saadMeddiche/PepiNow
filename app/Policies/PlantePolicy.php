<?php

namespace App\Policies;

use App\Models\Plante;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlantePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return true;

    }

    public function create(User $user)
    {
        return   $user->hasPermissionTo('Add-Plante') || $user->hasPermissionTo('*');
    }

    public function update(User $user, Plante $plante)
    {
        return $user->id == $plante->user_id && $user->hasPermissionTo('Update-Plante') || $user->hasPermissionTo('*');
    }

    public function delete(User $user, Plante $plante)
    {
        return $user->id == $plante->user_id && $user->hasPermissionTo('Delete-Plante') || $user->hasPermissionTo('*');
    }

}
