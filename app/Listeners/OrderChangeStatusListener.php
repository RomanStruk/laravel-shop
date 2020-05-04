<?php

namespace App\Listeners;

use App\Events\ChangeOrderStatusEvent;

class OrderChangeStatusListener
{

    /**
     * Handle the event.
     *
     * @param ChangeOrderStatusEvent $event
     * @return void
     */
    public function handle(ChangeOrderStatusEvent $event)
    {
        $event->order->orderChangeStatusMailNotification();
    }
}
