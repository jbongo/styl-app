<?php

namespace App\Notifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class RsacCompleted extends Notification
{
    use Queueable;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $photo = ($this->user->photo_profile) ? $this->user->photo_profile : "user.png" ;
        return [
            "id_user" => $this->user->id,
            "nom_user" => $this->user->nom,
            "prenom_user" =>$this->user->prenom,
            "photo" => $photo,
            "type_notif" => "complete_info_rsac",
            "message" => "A saisi ses informations d'immatriculation RSAC",
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
