<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Product;
use App\Services\Data\Order\DeleteOrder;
use App\Services\Data\Order\GetOrderById;
use App\Services\Data\Order\GetOrdersByLimit;
use App\Services\Data\Order\UpdateOrderStatus;
use App\Services\Data\UserDetail\UpdateUserDetail;
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
     * @param GetOrderById $getOrderById
     * @param integer $id
     * @return Factory|View
     */
    public function edit(GetOrderById $getOrderById,
                         $id)
    {
        $order = $getOrderById->handel($id);
        return view('admin.order.edit', [
            'order'=> $order,
            'products' => Product::all()->diff($order->products)
//            'warehouses'=> $warehousesByCityRef->handel($order->shipping->city_ref),
        ]);
    }


    /**
     * Update Order
     * @param GetOrderById $getOrderById
     * @param UpdateUserDetail $updateUserDetail
     * @param OrderRequest $request
     * @param int $orderId
     * @return RedirectResponse
     */
    public function update(GetOrderById $getOrderById,
                           UpdateUserDetail $updateUserDetail,
                           OrderRequest $request,
                           $orderId)
    {

        $order = $getOrderById->handel($orderId);

        // update user detail
        $updateUserDetail->handel($order->user, $request->userDetailFillData());

        // update comment of order
        $order->update(['comment' => $request->comment]);

        // update products of order
        $order->syncProducts($request->input(['products']));

        // update payment of order
        $order->paymentUpdate($request->paymentFillData());

        // update shipping of order
        $order->shippingUpdate($request->shippingFillData());

        return redirect()->back()->with('success', __('order.updated'));
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
