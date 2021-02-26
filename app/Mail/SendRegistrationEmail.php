<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;
 public $userDt;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        //
        $this->userDt=$notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user=$this->userDt;
        return $this->markdown('SendRegistrationEmail')->with('user',$user);;
    }
}
