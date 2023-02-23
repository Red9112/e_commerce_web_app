<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */


    public function before(User $user, $ability)
    {

if ($user->hasRole('admin') && in_array($ability,['update','delete','viewAny','create'])) return true;
    }
    public function viewAny(User $user)
    {
       return ($user->hasRole('admin'));
    }
 
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Shop $shop)
    {
       
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
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
