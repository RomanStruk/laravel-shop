<?php

namespace App\Observers;

use App\Order;
use App\OrderDetail;
use Carbon\Carbon;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $order_detail = new OrderDetail();
        $order_detail->order_id = $order->id;
        $order_detail->comment = 'Create Order';
        $order_detail->date_added = Carbon::now();
        $order_detail->save();
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
