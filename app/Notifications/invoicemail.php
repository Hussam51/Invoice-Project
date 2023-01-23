<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class invoicemail extends Notification
{
    use Queueable;
 private $invoice_id;
 private $username;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id=$invoice_id;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage) ->from('hussam@gmail.com','Hussam Alsyed Khalil')
                    ->greeting('Hello'.''.$notifiable->name)
                    ->subject('Welcom To Invoice Management System.')
                    ->line('Hello '.$notifiable->name.'This Message For Add Invoice Successfully ')
                    ->action('view invoice', route('invoice.details',$this->invoice_id))
                    ->line('Thank you for using our application!')
                 ;

    }



    public function toDatabase($notifiable)
    {
        return [
           'data' => $this->invoice_id,
           'notifiable'=>$notifiable->name,
           'type'=>'add invoice'
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
