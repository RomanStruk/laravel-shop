<?php


namespace App\Repositories;
use App\Order as Model;

class OrderRepository
{

    public function getAll()
    {
        $results = Model::with('products')
            ->with('user')
            ->with('user.detail')
            ->with('details')
            ->with('payment')
            ->with('shipping')
//            ->limit(5)
            ->get();
        $results->map(function ($order) {
            $order['detail_status'] = $order->details->sortByDesc('date_added')->first()['status'];
            $order['sum_price'] = $order->products->sum('price');
            return $order;
        });
        return $results;
    }

    public function getOrder($id)
    {
        $order = Model::with('products')
            ->with('products.category')
            ->with('user')
            ->with('user.detail')
            ->with('details')
            ->with('payment')
            ->with('shipping')
            ->findOrFail($id);
        $order['sum_price'] = $order->products->sum('price');
        $order['total_price'] = $order['sum_price'] + $order->shipping->shipping_rate;
        $order['detail_status'] = $order->details->sortByDesc('date_added')->first()['status'];
//        dd($order);
        return $order;
    }
}
