<?php

namespace App\Events;

use App\Models\Discount;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DiscountExpired
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $discount;

    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
