<?php

namespace App\Listeners;
use App\Models\User;
use  App\Events\UserHasRegistered;
use App\Events\NewVendorRequestEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewVenderNotification;
use Illuminate\Support\Facades\Notification;

class SendNewVenderNotificationLestener
{


    public function handle(NewVendorRequestEvent $event)

  {
      $user = $event->user;
      //$admin=User::findOrfail(1);
      $notification = new NewVenderNotification($user);
     // $admin->notify($notification);
     $admins=User::whereHas('roles', function ($query) {
     $query->where('name', 'admin');
   })->get();
  Notification::send($admins,$notification);

}
}
