<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FORMATIONS_ModifPlaceMe extends Mailable
{
    use Queueable, SerializesModels;

    public $formation;
    public $me;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formation, $me)
    {
        $this->formation = $formation;
        $this->me = $me;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.formationmodifplaceme')
        ->from('from@example.com','Stylimmo')
        ->subject('Formations - Modification du lieu d\' une formation')
        ->replyTo('rpagot@hotmail.fr');
    }
}
