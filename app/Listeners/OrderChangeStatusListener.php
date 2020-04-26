<?php

namespace App\Listeners;

use App\Events\ChangeOrderStatusEvent;
use App\Events\CreateOrderEvent;
use App\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
