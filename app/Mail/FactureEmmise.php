<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FactureEmmise extends Mailable
{
    use Queueable, SerializesModels;
    public $nom;
    public $file;
    public $mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom, $file, $mail)
    {
        $this->nom = $nom;
        $this->file = $file;
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('factures.mailfacture')
        ->from('from@example.com','Stylimmo')
        ->subject('Une facture à régeler de la part de stylimmo')
        ->attach($this->file)
        ->rePlyTo('bongojeanphilippe@gmail.com');
    }
}

