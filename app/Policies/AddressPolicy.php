<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;


    public function before(User $user, $ability)
    {
   if ($user->hasRole('admin') &&
      in_array($ability,['edit','update','delete','viewAny']))
      return true;
    }

    public function viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function edit(User $user, Address $address)
    {
        return ($user->id == $address->user->id);
    }

    public function update(User $user, Address $address)
    {
        return ($user->id == $address->user->id);
    }


    public function delete(User $user, Address $address)
    {
        return ($user->id == $address->user->id);
    }


    public function restore(User $user, Address $address)
    {
        //
    }


    public function forceDelete(User $user, Address $address)
    {
        //
    }
}
