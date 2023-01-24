<?php

namespace App\Listeners;


use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Routing\Events\RouteMatched;
use App\Events\MarkNotificationsAsReadEvent;





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
    public function handle(RouteMatched $event)
    {
 
}
}
