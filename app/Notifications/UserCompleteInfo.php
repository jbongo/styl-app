<?php

namespace App\Notifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class UserCompleteInfo extends Notification
{
    use Queueable;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
    
        $photo = ($this->user->photo_profile) ? $this->user->photo_profile : "user.png" ;
        return [
            "id_user" => $this->user->id,
            "nom_user" => $this->user->nom,
            "prenom_user" =>$this->user->prenom,
            "photo" => $photo,
            "type_notif" => "complete_info",
            "message" => "a completé son profil",
            "date" => Carbon::now()->format('d/m/Y à H:i'),
        ];
    }

    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
