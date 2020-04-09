<?php

namespace App\Observers;

use App\OrderHistory;
use Carbon\Carbon;

class OrderDetailObserver
{
    /**
     * Handle the order detail "created" event.
     *
     * @param  \App\OrderHistory  $orderDetail
     * @return void
     */
    public function creating(OrderHistory $orderDetail)
    {
        if (!$orderDetail->date_added) $orderDetail->date_added = Carbon::now();
    }

}
