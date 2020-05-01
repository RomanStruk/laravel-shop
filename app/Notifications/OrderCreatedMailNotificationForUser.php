<?php

namespace App\Notifications;

use App\Payment;
use App\Shipping;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedMailNotificationForUser extends Notification implements ShouldQueue
{
    use Queueable;

    private $orderId;
    private $user;
    private $products;
    private $payment;
    private $shipping;

    /**
     * Create a new notification instance.
     *
     * @param $orderId
     * @param User $user
     * @param $products
     * @param Payment $payment
     * @param Shipping $shipping
     */
    public function __construct($orderId, $user, $products, $payment, $shipping)
    {
        //
        $this->orderId = $orderId;
        $this->user = $user;
        $this->products = $products;
        $this->payment = $payment;
        $this->shipping = $shipping;
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
                    ->line('Шановний, '. $this->user->full_name . ' дякуємо за покупку')
                    ->line('Інформація про замовлення')
                    ->line('ID: '. $this->orderId);
    }

}
