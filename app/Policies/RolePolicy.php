<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;



    public function viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function store(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function edit(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function update(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function delete(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function restore(User $user, Role $role)
    {
        //
    }


    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
