<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username,$token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $token)
    {
        $this->username = $username ;
        $this->token = $token ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')->markdown('emails.reset-password')->with(['username'=>$this->username,'token'=>$this->token]);
        //return $this->subject('لقد تم تسجيلكم من قبل إدارة فوز بنجاح')->view('Mails.agents.agent-registration-mail',compact('email','pass'));
    }

}
