<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\Services\Analytics\Analytics;

class HomeController extends Controller
{
    public function index(Analytics $analytics)
    {

        $soldProducts = OrderProduct::top(5)->get();
        $topList = [];
        foreach ($soldProducts as $soldProduct) {
//            dd($soldProduct);
            //$product->orderProduct()->sold($range)->get()->sum('count')
            $c = $soldProduct->countProductGroupByWeek()->get()->pluck('count_sold')->toArray();
            $topList[] = [
                'analytic'=>$analytics->averageGrowthRate($c),
                'sales' => $soldProduct->c, // всього продано
                'product' => $soldProduct->product,
            ];
        }
        $orders = Order::filter(['dateDesc' => true])->allRelations()->paginate(5);

        return view('admin.home', ['topList' => $topList])
            ->with('orders', $orders);

    }
}
