<?php

namespace App\Listeners;
use  App\Events\UserHasRegistered;
use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewUserNotification
{
 

    public function handle(UserHasRegistered $event)

  {
      $user = $event->user;
    $notification = new NewUser($user);
    $admin = User::find(6);
    //$admin = User::where('is_admin','=',true);
    $admin->notify($notification);
}
}
