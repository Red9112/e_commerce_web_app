<?php

namespace App\Policies;

use App\Models\DiscountType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountTypePolicy
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
        return ($user->hasRole('vendor') && $user!=null);
    }


    public function view(User $user, DiscountType $discountType)
    {
        //
    }

    public function store(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function update(User $user, DiscountType $discountType)
    {
        return ($user->hasRole('admin'));
    }

     public function edit(User $user, DiscountType $discountType)
    {
        return ($user->hasRole('admin'));
    }

    public function delete(User $user, DiscountType $discountType)
    {
        return ($user->hasRole('admin'));
    }


    public function restore(User $user, DiscountType $discountType)
    {
        //
    }


    public function forceDelete(User $user, DiscountType $discountType)
    {
        //
    }
}
