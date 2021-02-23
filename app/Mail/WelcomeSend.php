<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class WelcomeSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $visiblePassword)
    {
        $this->user = $user;
        $this->visiblePassword = $visiblePassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Bienvenido a Prospectos Multiva")->markdown('emails.welcome.send')->with([
            'visiblePassword' => $this->visiblePassword,
            'user' => $this->user
        ]);
    }
}
