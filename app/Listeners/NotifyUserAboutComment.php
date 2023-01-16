<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Mail\BlogCommentPosted;
use App\Mail\ProductCommentPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserAboutComment
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
    public function handle(CommentPosted $event)
    {
        if ($event->comment->commentable_type=="App\Models\Blog") {  
        Mail::to($event->comment->commentable->user->email)->queue(new BlogCommentPosted($event->comment));
        }
        if ($event->comment->commentable_type=="App\Models\Product") {  
        Mail::to($event->comment->commentable->shop->user->email)->queue(new ProductCommentPosted($event->comment));
    }

}
}