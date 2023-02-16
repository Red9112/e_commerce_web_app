<?php

namespace App\Listeners;

use App\Events\DiscountExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteExpiredProducts
{

    public function __construct()
    {
        //
    }


    public function handle(DiscountExpired $event)
    {
        $event->discount->products()->detach();
        $event->discount->expired = true;
        $event->discount->save();
    }
}
