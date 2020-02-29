<?php

namespace App\Observers;

use App\OrderDetail;
use Carbon\Carbon;

class OrderDetailObserver
{
    /**
     * Handle the order detail "created" event.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return void
     */
    public function creating(OrderDetail $orderDetail)
    {
        if (!$orderDetail->date_added) $orderDetail->date_added = Carbon::now();
    }

}
