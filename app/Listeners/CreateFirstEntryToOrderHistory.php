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


    }
}
