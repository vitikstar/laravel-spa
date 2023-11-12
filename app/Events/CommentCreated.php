<?php

namespace App\Events;

use App\Mail\NewCommentMail;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CommentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    public function __construct($comment)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewCommentMail());

        $this->comment = $comment;
    }
}
