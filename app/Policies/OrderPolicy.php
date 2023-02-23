<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;



    public function before(User $user, $ability)
    {
   if ($user->hasRole('admin') &&
      in_array($ability,['update','delete','create','viewAny','view'])) 
      return true;
    }

    public function viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    } 

    public function view(User $user, Order $order)
    {
        return ($user->id==$order->user->id);
    }

    public function create(User $user)
    {
        return ($user->hasRole('vendor'));
    }


    public function update(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function delete(User $user, Order $order)
    {
        return ($user->hasRole('admin'));
    }

    public function restore(User $user, Order $order)
    {
        //
    }

    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
