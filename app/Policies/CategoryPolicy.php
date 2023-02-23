<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;


    public function before(User $user, $ability)
    {
   if ($user->hasRole('admin') &&
      in_array($ability,['update','delete','store','viewAny']))
      return true;
    }

    public function viewAny(User $user)
    {
        return ($user->hasRole('admin'));
    }


    public function view(User $user, Category $category)
    {
        //
    }


    public function store(User $user)
    {
       return ($user->hasRole('admin'));
    }

    public function edit(User $user, Category $category)
    {
        return ($user->hasRole('admin'));
    }
    public function update(User $user, Category $category)
    {
        return ($user->hasRole('admin'));
    }

    public function delete(User $user, Category $category)
    {
        return ($user->hasRole('admin'));
    }


    public function restore(User $user, Category $category)
    {
        //
    }


    public function forceDelete(User $user, Category $category)
    {
        //
    }
}
