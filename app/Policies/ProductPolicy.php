<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;
 
    public function before(User $user, $ability)
    {
   if ($user->hasRole('admin') &&
      in_array($ability,['update','delete','create','viewAny'])) 
      return true;
    }
    public function viewAny(User $user)
    {
        return ($user->hasRole('vendor') && $user!=null);
    }

    
    public function view(User $user, Product $product)
    {
        //
    }
    public function create(User $user)
    {
        return ($user->hasRole('vendor') && $user!=null);
    }

   
    public function update(User $user, Product $product)
    {
        $vendor=$product->shop->user;
        return ($user!=null && $user->hasRole('vendor') && $user->id == $vendor->id);
    }

   
    public function delete(User $user, Product $product)
    {
        $vendor=$product->shop->user;
        return ($user!=null && $user->hasRole('vendor') && $user->id == $vendor->id);
    }

    
    public function restore(User $user, Product $product)
    {
        //
    }

  
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
