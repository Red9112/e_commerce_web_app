<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;




    public function before(User $user, $ability)
    {

if ($user->hasRole('admin') && in_array($ability,
['update','delete','viewAny','store'])) 
return true;
    }



    public function viewAny(User $user)
    {
       return ($user->hasRole('admin'));
    }


    public function view(User $user, Shop $shop)
    {

    }


    public function store(User $user)
    {
        return ($user->hasRole('vendor'));
    }



    public function update(User $user, Shop $shop)
    {
      if ($user->id==$shop->user_id) return true;
    }


    public function delete(User $user, Shop $shop)
    {
        if ($user->hasRole('admin')) return true;
    }


    public function restore(User $user, Shop $shop)
    {
        //
    }


    public function forceDelete(User $user, Shop $shop)
    {
        //
    }
}
