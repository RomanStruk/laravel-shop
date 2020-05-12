<?php

namespace App\Listeners;

use App\Events\CompletedOrderStatusEvent;
use App\SoldProduct;
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
     * @param  CompletedOrderStatusEvent  $event
     * @return void
     */
    public function handle(CompletedOrderStatusEvent $event)
    {
            foreach ($event->order->products as $product){
                $soldProduct = new SoldProduct();
                $soldProduct->product_id =  $product->id;
                $soldProduct->sale_price =  $product->price;
                $soldProduct->created_at =  $event->order->created_at;
                $soldProduct->save();
                // todo - count products
            }
    }
}
