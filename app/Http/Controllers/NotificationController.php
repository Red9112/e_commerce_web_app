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


    public function markAsRead(Request $request,$id){
        $user=auth()->user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->update(['read_at' => now()]);
        $request->session()->flash('sucsess','notification marked as read !!');
        return redirect()->back();
       }



       public function destroy(Request $request,$id)
       {
        $user=auth()->user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->delete();
        $request->session()->flash('failed','notification  Deleted !!');
        return redirect()->back();

}



}
