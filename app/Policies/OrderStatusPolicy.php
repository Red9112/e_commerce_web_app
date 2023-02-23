<?php

namespace App\Policies;

use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderStatusPolicy
{
    use HandlesAuthorization;




    public function viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    }

    public function store(User $user, OrderStatus $orderStatus)
    {
        return ($user->hasRole('admin'));
    }

    public function edit(User $user, OrderStatus $orderStatus)
    {
        return ($user->hasRole('admin'));
    }

    public function update(User $user, OrderStatus $orderStatus)
    {
        return ($user->hasRole('admin'));
    }


    public function delete(User $user, OrderStatus $orderStatus)
    {
        return ($user->hasRole('admin'));
    }


    public function restore(User $user, OrderStatus $orderStatus)
    {
        //
    }


    public function forceDelete(User $user, OrderStatus $orderStatus)
    {
        //
    }


}
