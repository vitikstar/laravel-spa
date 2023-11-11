<?php

namespace App\Events;

use App\Mail\NewUserMail;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct($user)
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewUserMail());

        $this->user = $user;
    }
}

?>
