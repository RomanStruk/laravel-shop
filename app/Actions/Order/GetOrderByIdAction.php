<?php


namespace App\Actions\Order;


use App\Tasks\Order\FindOrderByIdTask;
use App\Tasks\Order\GetOrderStatusTask;

class GetOrderByIdAction
{
    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function run(int $id)
    {
        (new FindOrderByIdTask())->get($id);
        $order = (new GetOrderStatusTask())->get();
        $order->map(function ($order) {
            $order['sum_price'] = $order->products->sum('price');
            $order['total_price'] = $order['sum_price'] + $order->shipping->shipping_rate;
        });
//        dd($order);
        return $order->first();
    }
}
