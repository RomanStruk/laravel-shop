<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Services\Data\Order\DeleteOrder;
use App\Services\Data\Order\GetOrderById;
use App\Services\Data\Order\GetOrdersByLimit;
use App\Services\Data\Order\UpdateOrderStatus;
use App\Services\Data\Shipping\GetCityByRef;
use App\Services\Data\Shipping\GetWarehousesByCityRef;
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
     * @param GetWarehousesByCityRef $warehousesByCityRef
     * @param integer $id
     * @return Factory|View
     * @throws \Exception
     */
    public function edit(GetOrderById $getOrderById,
                         GetWarehousesByCityRef $warehousesByCityRef,
                         $id)
    {
        $order = $getOrderById->handel($id);
        return view('admin.order.edit', [
            'order'=> $order,
            'warehouses'=> $warehousesByCityRef->handel($order->shipping->city_ref),
        ]);
    }


    /**
     * @param GetOrderById $getOrderById
     * @param UpdateUserDetail $updateUserDetail
     * @param GetWarehousesByCityRef $getWarehousesByCityRef
     * @param GetCityByRef $getCityByRef
     * @param OrderRequest $request
     * @param int $orderId
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(GetOrderById $getOrderById,
                           UpdateUserDetail $updateUserDetail,
                           GetWarehousesByCityRef $getWarehousesByCityRef,
                           GetCityByRef $getCityByRef,
                           OrderRequest $request,
                           $orderId)
    {

        $order = $getOrderById->handel($orderId);
        $updateUserDetail->handel(
            $order->user,
            $request->userDetailFillData()
        );
        $order->syncProducts($request->input(['products']));

        $order->paymentUpdate($request->paymentFillData());

        $inputShipping = $request->shippingFillData();
        if ($order->shipping->city_ref != $inputShipping['city_ref']){
            $cityInformation = $getCityByRef->handel($inputShipping['city_ref']);
            $inputShipping['city_ref'] = $cityInformation['Ref'];
            $inputShipping['city'] = $cityInformation['SettlementTypeDescription'].$cityInformation['Description'];
            $inputShipping['region'] = $cityInformation['RegionsDescription'];
            $inputShipping['area'] = $cityInformation['AreaDescription'];
        }elseif ($inputShipping['method'] == 'novaposhta'){

            $warehouses = $getWarehousesByCityRef->handel($inputShipping['city_ref']);
            $inputShipping['warehouse_title'] = 'Don`t choose';
            if (key_exists('warehouse_ref', $warehouses)){
                $inputShipping['warehouse_title'] = $warehouses[$inputShipping['warehouse_ref']]->Description;
            }
        }
        $order->shippingUpdate($inputShipping);

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
