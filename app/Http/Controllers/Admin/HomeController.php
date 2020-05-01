<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Services\Analytics\Analytics;
use App\Services\Data\SoldProduct\GetCountProductGroupByWeek;
use App\Services\Data\SoldProduct\GetTopProductsByLimit;

class HomeController extends Controller
{
    public function index(
        Analytics $analytics,
        GetTopProductsByLimit $topProducts,
        GetCountProductGroupByWeek $productGroupByWeek)
    {

        $products = $topProducts->handel(5);
        $topList = [];
        foreach ($products as $product) {
            $volumePeriods = $productGroupByWeek->handel($product->product->id);
            $topList[] = [
                'analytic'=>$analytics->averageGrowthRate($volumePeriods),
                'sales' => $product->c,
                'product' => $product->product,
            ];

        }

//        dump($topList);

        $orders = Order::filter(['dateDesc' => true])->allRelations()->paginate(5);

        return view('admin.home', ['topList' => $topList])
            ->with('orders', $orders);

    }
}
