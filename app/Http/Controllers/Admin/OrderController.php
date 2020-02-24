<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index')->with('orders', $orders);
    }

    public function revision(Order $order)
    {
        return view('admin.order.revision');
    }
}
