<?php

namespace App\Notifications;

use App\Models\Produit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class NouveauProduit extends Notification
{
    use Queueable;
    public $produit;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($produit)
    {
        $this->produit= $produit;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $produit=$this->produit;
        return (new MailMessage)->subject("modification d'un produit sur OpenShop")->markdown('notifications.produit.nouveau-produit', compact("produit"));
    }


        /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
                    ->content("Bonjour ! un nouveau produit vient d'ajouter sur openShop");
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
