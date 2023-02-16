<?php

namespace App\Providers;

use App\Events\CommentPosted;
use App\Events\DiscountExpired;
use App\Events\UserHasRegistered;
use App\Events\NewVendorRequestEvent;
use Illuminate\Auth\Events\Registered;
use App\Listeners\DeleteExpiredProducts;
use App\Listeners\NotifyUserAboutComment;
use Illuminate\Routing\Events\RouteMatched;
use App\Events\MarkNotificationsAsReadEvent;
use App\Listeners\MarkNotificationsAsReadListener;
use App\Listeners\SendNewVenderNotificationLestener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentPosted::class => [
            NotifyUserAboutComment::class,
        ],
        UserHasRegistered::class => [
          //
        ],
        NewVendorRequestEvent::class => [
            SendNewVenderNotificationLestener::class,
        ],
        DiscountExpired::class => [
            DeleteExpiredProducts::class,
        ],




    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
