<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeGuest extends Mailable
{
    use Queueable, SerializesModels;

    public $guestuser;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($guestuser, $password)
    {
        $this->guestuser = $guestuser;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('visiteurs.mail.welcomeguest')
        ->from('from@example.com','Stylimmo')
        ->subject('Suivi de votre affaire sur STYL\'IMMO')
        ->rePlyTo('bongojeanphilippe@gmail.com');
    }
}
