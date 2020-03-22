<?php


namespace App\Actions\Order;


use App\Tasks\Order\GetAllOrdersTask;
use App\Tasks\Order\GetOrderStatusTask;
use Illuminate\Http\Request;

class GetAllOrdersAction
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function run(Request $request)
    {
        $orders = (new GetAllOrdersTask)->get($request);
        $orders = (new GetOrderStatusTask())->get();
//        dd($orders->first());
        return $orders;
    }
}
