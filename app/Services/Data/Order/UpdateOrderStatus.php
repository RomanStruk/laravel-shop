<?php


namespace App\Services\Data\Order;


use App\Order;
use App\OrderHistory;

class UpdateOrderStatus
{
    public function handel($orderId, $insert)
    {

        $order = Order::findOrFail($orderId);
        $orderDetail = new OrderHistory([
            'status' => $insert['status'],
            'user_id' => \Auth::user()->id,
            'comment' => $insert['comment']
        ]);
         $order->histories()->save($orderDetail);
         $order->update(['status' => $insert['status']]);
        return $order;
    }
}
