<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Order;
use App\OrderDetail;
use App\Repositories\OrderRepository;
use App\Repositories\ShippingRepository;
use App\Services\OrderService;
use Exception;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var ShippingRepository
     */
    private $shippingRepository;

    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        ShippingRepository $shippingRepository,
        OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->shippingRepository = $shippingRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderRepository->getAll();
        return view('admin.order.index')->with('orders', $orders);
    }

    public function show($order)
    {
        $order = $this->orderRepository->getOrder($order);
        return view('admin.order.revision')->with('order', $order);
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
        } catch (Exception $e) {
        }
        return redirect()->route('admin.order.index')->with('success', 'Замовлення успішно видалено');
    }

    public function edit($order)
    {
        $order = $this->orderRepository->getOrder($order);
//        dd($warehouses, $order->shipping);
        return view('admin.order.edit')
            ->with('order', $order)
            ->with('warehouses', $this->shippingRepository->getParserWarehouses($order->shipping->city_ref));
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->user->detail()->update(
            $request->only(['first_name', 'last_name', 'phone'])
        );

        $payment = $request->only(['paid']);
        $payment['method'] = $request->input(['method_pay']);
        $order->payment()->update($payment);

        $order->products()->sync($request->input(['products']));

        $shipping = $request->only(['street', 'house', 'flat', 'warehouse_ref']);
        $shipping['method'] = $request->input('shipping_method');
        if ($shipping['method'] == 'novaposhta'){
            $shipping['warehouse_title'] = $this->shippingRepository->getParserWarehouses($order->shipping->city_ref)[$request->input('warehouse_ref')];
        }
        if ($order->shipping->city_ref != $request->input('city_ref')){
            $city = $this->shippingRepository->findRef($request->input('city_ref'));
            $data = $this->shippingRepository->parserResult($city);
            if ($data){
                $shipping += $data;
            }
        }
//        dd($shipping);
        $order->shipping()->update($shipping);

        return redirect()->back()->with('success', 'Замовлення успішно змінено');
    }

    /**
     * Зміна статусу замовлення
     * @param StatusOrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(StatusOrderRequest $request, Order $order)
    {
        $status = new OrderDetail($request->only('status', 'comment'));
        $order->details()->save($status);
        return redirect()->back()->with('success', 'Статус замовлення успішно змінений');
    }
}
