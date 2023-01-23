<?php

namespace App\Listeners;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\MarkNotificationsAsReadEvent;
use Illuminate\Routing\Events\RouteMatched;





class MarkNotificationsAsReadListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MarkNotificationsAsReadEvent $event)
    {
        $user =auth()->user();
dd($user);
        $user = $event->user;
   $user->unreadNotifications()->update(['read_at' => now()]);
}
}
