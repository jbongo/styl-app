<?php

namespace App\Mail;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserAccountCreate extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return $user
     */
    public function __construct($user)
    {
        $this->user = $user ;
        $tmp = Crypt::decryptString($user->password_temporaire);
        $sub1 = substr($tmp, strpos($tmp, '"') + 1, strlen($tmp) - 5);
        $sub2 = substr($sub1, 0, strpos($sub1, '"')); 
        $user->password_temporaire = $sub2;
        $user->password_temporaire = $sub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('users.mailAccountCreate')
        ->from('from@example.com','Stylimmo')
        ->subject('Votre compte stylimmo a été crée ')
        ->rePlyTo('bongojeanphilippe@gmail.com');
    }
}
