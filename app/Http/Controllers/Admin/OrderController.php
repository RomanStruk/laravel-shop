<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Order\DeleteOrderAction;
use App\Actions\Order\EditOrderAction;
use App\Actions\Order\GetAllOrdersAction;
use App\Actions\Order\GetOrderByIdAction;
use App\Actions\Order\UpdateOrderAction;
use App\Actions\Order\UpdateOrderStatusAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Services\Data\Order\DeleteOrder;
use App\Services\Data\Order\GetOrderById;
use App\Services\Data\Order\GetOrdersByLimit;
use App\Services\Data\Order\UpdateOrderStatus;
use App\Tasks\Shipping\GetWarehousesByCityRef;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    /**
     * @param GetOrdersByLimit $getOrdersByLimit
     * @param Request $request
     * @return Factory|View
     */
    public function index(GetOrdersByLimit $getOrdersByLimit, Request $request)
    {
        $orders = $getOrdersByLimit->handel($request->except('limit'));
        return view('admin.order.index')
            ->with('orders', $orders);
    }

    /**
     * @param GetOrderById $getOrderById
     * @param integer $id
     * @return Factory|View
     */
    public function show(GetOrderById $getOrderById, $id)
    {
        $order = $getOrderById->handel($id);

        return view('admin.order.show')->with('order', $order);
    }


    /**
     * @param EditOrderAction $action
     * @param GetOrderById $getOrderById
     * @param integer $id
     * @return Factory|View
     * @throws \Exception
     */
    public function edit(EditOrderAction $action,GetOrderById $getOrderById, \App\Services\Data\Shipping\GetWarehousesByCityRef $warehousesByCityRef,  $id)
    {
//        return view('admin.order.edit', $action->run($id));
        $order = $getOrderById->handel($id);
        $warehouses = $warehousesByCityRef->handel($order->shipping->city_ref);
        return view('admin.order.edit', [
            'warehouses'=> $warehouses,
            'order'=> $order
            ]);
    }


    /**
     * @param UpdateOrderAction $action
     * @param OrderRequest $request
     * @param int $orderId
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(UpdateOrderAction $action, OrderRequest $request, $orderId)
    {
        $action->run($request, $orderId);
        return redirect()->back()->with('success', 'Замовлення успішно змінено');
    }

    /**
     * Зміна статусу замовлення
     * @param UpdateOrderStatus $updateOrderStatus
     * @param StatusOrderRequest $request
     * @param integer $orderId
     * @return RedirectResponse
     */
    public function updateStatus(UpdateOrderStatus $updateOrderStatus,
                                 StatusOrderRequest $request,
                                 $orderId)
    {
        $updateOrderStatus->handel($orderId, $request->validated());
        return redirect()->back()->with('success', __('order.status_updated'));
    }


    /**
     * @param DeleteOrder $deleteOrder
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(DeleteOrder $deleteOrder, $id)
    {
        $deleteOrder->handel($id);
        return redirect()->route('admin.order.index')
            ->with('success', __('order.deleted'));
    }
}
