<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FORMATIONS_Unsubscribe extends Mailable
{
    use Queueable, SerializesModels;

    public $formation;
    public $usr;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formation, $usr)
    {
        $this->formation = $formation;
        $this->usr = $usr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.formationunsubscribe')
        ->from('from@example.com','Stylimmo')
        ->subject('Formations - Désinscription à une formation')
        ->replyTo('rpagot@hotmail.fr');
    }
}
