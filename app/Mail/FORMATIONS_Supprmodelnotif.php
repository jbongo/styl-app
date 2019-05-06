<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FORMATIONS_Supprmodelnotif extends Mailable
{
    use Queueable, SerializesModels;

    public $formation;
    public $user;
    public $canceler;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formation, $user, $canceler)
    {
        $this->formation = $formation;
        $this->user = $user;
        $this->canceler = $canceler;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.formationcancelnotif')
        ->from('from@example.com','Stylimmo')
        ->subject('Formations - Notification de suppression d\' un modèle de formation')
        ->replyTo('rpagot@hotmail.fr');
    }
}
