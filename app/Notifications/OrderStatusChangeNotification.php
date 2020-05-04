<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChangeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $products;
    private $orderId;
    private $status;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $products
     * @param $orderId
     * @param $status
     */
    public function __construct($user, $products, $orderId, $status)
    {
        //
        $this->user = $user;
        $this->products = $products;
        $this->orderId = $orderId;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Order Change')
            ->line('Ваше замовлення було розглянуто')
            ->line('Статус змінений на "'.$this->status.'"');
    }
}
