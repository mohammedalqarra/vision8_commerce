<?php

namespace App\Notifications;

use App\Models\Order;
use FontLib\Table\Type\name;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;

class NewOrder extends Notification
{
    use Queueable;

    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        //
        $this->order= $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
       // $notification_channel = 'database,broadcast,vonage';
        $notification_channel = 'database,broadcast';
        $channel = explode(',' , $notification_channel);
        return $channel;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    // public function toVonage($notifiable)
    // {
    //     return (new VonageMessage)
    //                 ->content('Your unicode message');

    // }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         'data' => 'Thare is new Order ('.$this->order->user->name.') With Number (#'.$this->order->id.')',
    //         'url' => URL('/'),
    //     ];
    // }
    // public function toBroadcast($notifiable)
    // {
    //     return [
    //         'data' => 'Thare is new Order ('.$this->order->user->name.') With Number (#'.$this->order->id.')',
    //         'url' => URL('/'),
    //     ];
    // }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'data' => 'Thare is new Order ('.$this->order->user->name.') With Number (#'.$this->order->id.')',
            'url' => URL('/'),
        ];
    }
}
