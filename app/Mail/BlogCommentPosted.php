<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogCommentPosted extends Mailable 
{
    public $comment;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment=$comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
  
        $subject=' Comment Posted for Blog :'.$this->comment->commentable->title;

return $this
// ->attach(storage_path('app/public').'/'.$this->comment->user->image->url,
// [
// 'as'=>'profile_pic.jpg',
// ])
// ->attachFromStorageDisk('public',$this->comment->user->image->url,'profile_pic.jpg')
//->attachFromStorage($this->comment->user->image->url,'profile_pic.jpg')
        ->subject($subject)
        ->view('mails\blogs\comment');
    }
}
