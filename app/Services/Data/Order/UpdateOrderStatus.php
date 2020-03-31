<?php


namespace App\Services\Data\Order;


use App\Order;
use App\OrderDetail;

class UpdateOrderStatus
{
    public function handel($orderId, $insert)
    {

        $order = Order::findOrFail($orderId);
        $orderDetail = new OrderDetail([
            'status' => $insert['status'],
            'comment' => $insert['comment']
        ]);
        return $order->details()->save($orderDetail);
    }
}
