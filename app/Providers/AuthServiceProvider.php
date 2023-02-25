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
          'App\Models\Category' => 'App\Policies\CategoryPolicy',
          'App\Models\Discount' => 'App\Policies\DiscountPolicy',
          'App\Models\DiscountType' => 'App\Policies\DiscountTypePolicy',
          'App\Models\Shipping' => 'App\Policies\ShippingPolicy',
          'App\Models\Payment' => 'App\Policies\PaymentPolicy',
          'App\Models\Address' => 'App\Policies\AddressPolicy',
          'App\Models\OrderStatus' => 'App\Policies\OrderStatusPolicy',
          'App\Models\Role' => 'App\Policies\RolePolicy',

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
