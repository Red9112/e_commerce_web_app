<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;
 

    public function before(User $user, $ability)
{

 if ($user->hasRole('admin') && in_array($ability,['update','delete'])) return true;
}
    public function viewAny(User $user)
    {
        //
    }



    public function view(User $user, Blog $blog)
    {
        //
    }
 
    
    public function create(User $user)
    {
        return ($user!=null);
    }


    public function update(User $user, Blog $blog)
    {
        return ($user->id == $blog->user_id);
    }

   
    public function delete(User $user, Blog $blog)
    {
        return ($user->id == $blog->user_id);
    }

  
    public function restore(User $user, Blog $blog)
    {
        //
    }

   
    public function forceDelete(User $user, Blog $blog)
    {
        //
    }
}
