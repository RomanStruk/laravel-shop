<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Services\Analytics\Analytics;
use App\SoldProduct;

class HomeController extends Controller
{
    public function index(Analytics $analytics)
    {

        $soldProducts = SoldProduct::top(5)->get();
        $topList = [];
        foreach ($soldProducts as $soldProduct) {
            $c = $soldProduct->product->sold()->countProductGroupByWeek()->get()->pluck('c')->toArray();
            $topList[] = [
                'analytic'=>$analytics->averageGrowthRate($c),
                'sales' => $soldProduct->c,
                'product' => $soldProduct->product,
            ];

        }

        $orders = Order::filter(['dateDesc' => true])->allRelations()->paginate(5);

        return view('admin.home', ['topList' => $topList])
            ->with('orders', $orders);

    }
}
