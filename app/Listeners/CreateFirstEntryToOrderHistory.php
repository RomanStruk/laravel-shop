<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\OrderHistory;
use Carbon\Carbon;

class CreateFirstEntryToOrderHistory
{
    /**
     * Handle the event.
     *
     * @param  OrderCreatedEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $order_detail = new OrderHistory();
        $order_detail->order_id = $event->order->id;
        $order_detail->user_id = $event->order->user_id;
        $order_detail->comment = 'Create Order';
        $order_detail->date_added = Carbon::now();
        $order_detail->save();
    }
}
