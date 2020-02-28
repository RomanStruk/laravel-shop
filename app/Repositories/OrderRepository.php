<?php


namespace App\Repositories;
use App\Order as Model;

class OrderRepository
{
    public function getAll()
    {
        return Model::with('products')->with('user')->get();
    }

    public function getOrder($id)
    {
        $order = Model::findOrFail($id);
        $order['products'] = $order->products()->with('category')->get();
        $order['sum'] = $order->products->sum('price');
        $order->load('shipping');
//        dd($order);
        return $order;
    }
}
