<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusOrderRequest;
use App\Order;
use App\OrderDetail;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
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
//        dd($order = factory(Order::class, 3)->make(['user_id' => 1]));
        $orders = $this->orderRepository->getAll();
        return view('admin.order.index')->with('orders', $orders);
    }

    public function revision($order)
    {
        $order = $this->orderRepository->getOrder($order);
//        dd($order);
        return view('admin.order.revision')->with('order', $order);
    }

    /**
     * Зміна статусу замовлення
     * @param StatusOrderRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editStatus(StatusOrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = new OrderDetail($request->only('status', 'comment'));
        $order->details()->save($status);
        return redirect()->back()->with('success', 'Статус замовлення успішно змінений');
    }
}
