<?php


namespace App\Services\Data\Order;


use App\Order;

class GetOrderById
{
    public function handel($id, $fields = ['*'], $trashed = false): Order
    {
        $order = Order::select($fields);

        if ($trashed) $order->withTrashed();

        $order->with('products')
            ->with('products.category')
            ->with('user')
            ->with('user.detail')
            ->with('histories')
            ->with('payment')
            ->with('shipping');

        $order = $order->findOrFail($id);

        return $order;
    }
}
