<?php


namespace App\Actions\Order;


use App\Tasks\Order\FindOrderByIdTask;
use App\Tasks\Shipping\GetWarehousesByCityRef;

class EditOrderAction
{
    public function run($id)
    {
        $order = (new FindOrderByIdTask())->get($id)->first();
        $warehouses = (new GetWarehousesByCityRef())->get($order->shipping->city_ref);
        return [
            'warehouses'=> $warehouses,
            'order'=> $order
        ];
    }
}
