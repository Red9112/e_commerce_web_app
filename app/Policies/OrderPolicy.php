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
      in_array($ability,
      ['update','delete','order_cancel','admin_viewAny','vendor_viewAny']))
      return true;
    }
 
    public function admin_viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function vendor_viewAny(User $user, Order $order)
    {
        return ($user->hasRole('vendor'));
    }

    public function order_show(User $user, Order $order)
    {
        return ($user->id==$order->user->id);
    }

    public function order_vendor_show(User $user)
    {
        return ($user->hasRole('vendor'));
    }


    public function set_order_status(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function order_cancel(User $user, Order $order)
    {
        return ($user->id==$order->user->id);
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
