<?php

namespace App\Listeners;

use App\Events\CreateOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrderListener
{
    /**
     * Handle the event.
     *
     * @param CreateOrderEvent $event
     * @return void
     */
    public function handle(CreateOrderEvent $event)
    {
        $event->order->orderCreatedNotification();
    }
}
