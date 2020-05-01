<?php

namespace App\Observers;

use App\OrderHistory;
use Carbon\Carbon;

class OrderHistoryObserver
{
    /**
     * Handle the order detail "creating" event.
     *
     * @param OrderHistory $orderHistory
     * @return void
     */
    public function creating(OrderHistory $orderHistory)
    {
        if (!$orderHistory->date_added) $orderHistory->date_added = Carbon::now();
    }

}
