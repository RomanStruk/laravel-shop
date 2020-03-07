<?php


namespace App\Actions\Order;


use App\Tasks\Order\GetAllOrdersTask;
use App\Tasks\Order\GetOrderStatusTask;

class GetAllOrdersAction
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function run()
    {
        $orders = (new GetAllOrdersTask)->get();
        $orders = (new GetOrderStatusTask())->get();
//        dd($orders->first());
        return $orders;
    }
}
