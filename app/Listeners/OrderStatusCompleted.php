<?php

namespace App\Listeners;

use App\Events\CompletedOrderStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderStatusCompleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param CompletedOrderStatusEvent $event
     * @return void
     */
    public function handle(CompletedOrderStatusEvent $event)
    {
        // todo - count products
        foreach ($event->order->orderProducts as $orderProduct) {
            $orderProduct->syllable->remains = $orderProduct->syllable->remains - $orderProduct->count;
            $orderProduct->syllable->processed = $orderProduct->syllable->processed - $orderProduct->count;
            $orderProduct->syllable->save();

        }
    }
}
