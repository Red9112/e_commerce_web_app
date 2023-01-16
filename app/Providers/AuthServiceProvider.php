<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Shop' => 'App\Policies\ShopPolicy',
         'App\Models\Blog' => 'App\Policies\BlogPolicy',
         'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

// Gate::define('user.index',function($user){
//     return ($user->is_admin);
// });

//{{--Policies--}}
// Gate::define('blog.update','App\Policies\BlogPolicy@update');  //for a single function
// Gate::resource('blog','App\Policies\BlogPolicy');             //for all the policy functions
////////////////////// 
//{{----- Gates: ---}}
// Gate::define('blog.update',function($user,$blog){
//     return ($user->id == $blog->user_id);
// });
// Gate::define('blog.delete',function($user,$blog){
//     return ($user->id == $blog->user_id);
// });
// Gate::before(function($user,$ability){
//  if ($user->is_admin && in_array($ability,['blog.update','blog.delete'])) return true;
// });
////////////////////////





    }
}
