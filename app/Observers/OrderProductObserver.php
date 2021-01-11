<?php

namespace App\Observers;

use App\OrderProduct;

class OrderProductObserver
{
    /**
     * Handle the order product "creating" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function creating(OrderProduct $orderProduct)
    {
        if($orderProduct->syllable_id == null){
            $orderProduct->syllable_id = $orderProduct->product->getAvailableSyllableId((int)$orderProduct->count);
        }
    }

    /**
     * Handle the order product "created" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function created(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "updated" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function updated(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "deleted" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function deleted(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "restored" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function restored(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "force deleted" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function forceDeleted(OrderProduct $orderProduct)
    {
        //
    }
}
