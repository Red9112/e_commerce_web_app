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
          'App\Models\Product' => 'App\Policies\ProductPolicy',
          'App\Models\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//{{----- Gate: ---}}
Gate::define('notification',function($user){
    return $user->hasRole('admin');
});

////////////////////////






    }
}
