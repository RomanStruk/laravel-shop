<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index')->with('orders', $orders);
    }

    public function revision($order)
    {
        $order = $this->orderRepository->getOrder($order);
//        dd($order['products']);
//        dd($order);
        return view('admin.order.revision')->with('order', $order);
    }
}
