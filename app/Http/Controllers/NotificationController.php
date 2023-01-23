<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MarkNotificationsAsReadEvent;

class NotificationController extends Controller
{
    public function __construct()
    {

    }

    public function index(){
     $user=auth()->user();
       // event(new MarkNotificationsAsReadEvent($user));
        return view('notifications',[
            'nm'=>1
        ]);
    }


}
