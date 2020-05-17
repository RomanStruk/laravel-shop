<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChangeOrderStatusEvent;
use App\Events\CompletedOrderStatusEvent;
use App\Events\OrderCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Order;
use App\Services\PaginateSession;
use App\Services\Shipping\ShippingBase;
use App\Shipping;
use App\Syllable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    /**
     * @param Request $request
     * @param PaginateSession $paginateSession
     * @return Factory|View
     */
    public function index(Request $request, PaginateSession $paginateSession)
    {
        $filter = $request->except('limit');
        $filter['date-desc'] = 'true';
        $orders = Order::filter($filter)->allRelations()->paginate($paginateSession->getLimit());
        return view('admin.order.index')->with('orders', $orders);
    }

    /**
     * @param integer $id
     * @return Factory|View
     */
    public function show($id)
    {
        $order = Order::allRelations()->withTrashed()->findOrFail($id);
        /*foreach ($order->notifications as $notification) {
            dump($notification) ;
        }*/
        return view('admin.order.show')->with('order', $order);
    }

    public function create()
    {
        return view('admin.order.create');
    }


    public function store(OrderRequest $request)
    {
        // create new Order
        $order = new Order($request->orderFillData());
        // TODO check count available products
        // try to save order
        $order->save();

        // sync products
        $order->syncProducts($request->productsFillData());

        //create payment information
        $order->paymentCreate($request->paymentFillData());

        // create shipping information
        $shipping = $request->shippingFillData();
        $shippingBase = new ShippingBase(Shipping::$shipping_methods, $shipping['method']);
        $shipping['city'] = $shippingBase->setCity($shipping['city'])->cityFillDataForSave();
        $shipping['address'] = $shippingBase->setAddress($shipping['address'])->addressFillDataForSave();
        $order->shippingCreate($shipping);

        // event
        event(new OrderCreatedEvent($order));

        return redirect()->route('admin.order.show', $order)->with('success', __('order.save'));
    }

    /**
     * @param $orderId
     * @return Factory|View
     */
    public function edit($orderId)
    {
        // get order
        $order = Order::allRelations()->withTrashed()->findOrFail($orderId);
        return view('admin.order.edit', ['order'=> $order]);
    }


    /**
     * Update Order
     * @param OrderRequest $request
     * @param int $orderId
     * @return RedirectResponse
     */
    public function update(OrderRequest $request, $orderId)
    {
        // get order
        $order = Order::allRelations()->withTrashed()->findOrFail($orderId);

        // update comment of order
        $order->update($request->orderFillData());

        // update products of order
        $order->syncProducts($request->productsFillData());

        // update payment of order
        $order->paymentUpdate($request->paymentFillData());

        // update shipping of order
        $shipping = $request->shippingFillData();
        $shippingBase = new ShippingBase(Shipping::$shipping_methods, $shipping['method']);
        $shipping['city'] = $shippingBase->setCity($shipping['city'])->cityFillDataForSave();
        $shipping['address'] = $shippingBase->setAddress($shipping['address'])->addressFillDataForSave();
        $order->shippingUpdate($shipping);

        return redirect()->back()->with('success', __('order.updated'));
    }

    /**
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        return Order::destroy($id) ?
            redirect()->route('admin.order.index')->with('success', __('order.deleted')):
            redirect()->route('admin.order.index')->withErrors(__('order.error_delete'));
    }

    /**
     * Зміна статусу замовлення
     * @param StatusOrderRequest $request
     * @param integer $orderId
     * @return RedirectResponse
     */
    public function updateStatus(StatusOrderRequest $request, $orderId)
    {
        // update order status
        $order = Order::findOrFail($orderId);
        $order->statusUpdate($request->statusFillData());

        // create event for completed status
        if ($request->status == Order::STATUS_COMPLETED) event(new CompletedOrderStatusEvent($order));

        // create event for change status
        if ($request->get('notification')) event(new ChangeOrderStatusEvent($order));

        // redirect back
        return redirect()->back()->with('success', __('order.status_updated'));
    }


    /**
     * @param $orderId
     * @return Factory|View
     */
    public function printOrder($orderId)
    {
        $order = Order::allRelations()->findOrFail($orderId);
        return view('admin.order.print_order')->with('order', $order);
    }
}
