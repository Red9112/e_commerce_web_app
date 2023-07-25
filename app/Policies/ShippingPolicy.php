<?php

namespace App\Policies;

use App\Models\Shipping;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShippingPolicy
{
    use HandlesAuthorization;


    public function before(User $user, $ability)
    {
   if ($user->hasRole('admin') &&
      in_array($ability,['edit','update','delete','store','viewAny']))
      return true;
    }


    public function viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function view(User $user, Shipping $shipping)
    {
        //
    }


    public function edit(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function store(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function update(User $user, Shipping $shipping)
    {
        return ($user->hasRole('admin'));
    }


    public function delete(User $user, Shipping $shipping)
    {
        return ($user->hasRole('admin'));
    }


    public function restore(User $user, Shipping $shipping)
    {
        //
    }


    public function forceDelete(User $user, Shipping $shipping)
    {
        //
    }
}
