<?php

namespace App\Policies;

use App\Models\Discount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
   if ($user->hasRole('admin') &&
      in_array($ability,['update','delete','store','viewAny','affect_to_products']))
      return true;
    }

    public function viewAny(User $user)
    {
        return ($user->hasRole('vendor') && $user!=null);
    }

    public function affect_to_products(User $user)
    {
        return ($user->hasRole('vendor'));
    }


    public function view(User $user, Discount $discount)
    {
        //
    }


     public function store(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function update(User $user, Discount $discount)
    {
        return ($user->hasRole('admin'));
    }

     public function edit(User $user, Discount $discount)
    {
        return ($user->hasRole('admin'));
    }



    public function delete(User $user, Discount $discount)
    {
        return ($user->hasRole('admin'));
    }



    public function restore(User $user, Discount $discount)
    {
        //
    }


    public function forceDelete(User $user, Discount $discount)
    {
        //
    }
}
