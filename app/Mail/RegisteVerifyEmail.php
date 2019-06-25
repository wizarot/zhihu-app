<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisteVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * RegisteVerifyEmail constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verify')
            ->with([
                'name' => $this->user->name,
                'url' => route('email.verify',['token'=>$this->user->confirmation_token]),
            ]);
    }
}
