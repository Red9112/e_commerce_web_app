<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductCommentPosted extends Mailable
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
      $subject=' Comment Posted for Product :'.$this->comment->commentable->name;
        return $this
       // ->attachFromStorage($this->comment->user->image->url,'profile_pic.jpg')
        ->subject($subject)
        ->markdown('mails.products.comment-markdown');
    }
}
