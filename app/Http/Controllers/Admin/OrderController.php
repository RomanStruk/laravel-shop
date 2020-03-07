<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Order\DeleteAction;
use App\Actions\Order\EditOrderAction;
use App\Actions\Order\GetAllOrdersAction;
use App\Actions\Order\GetOrderByIdAction;
use App\Actions\Order\UpdateAction;
use App\Actions\Order\UpdateOrderStatusAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Services\OrderService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{

    /**
     * @param GetAllOrdersAction $action
     * @return Factory|View
     */
    public function index(GetAllOrdersAction $action)
    {
        return view('admin.order.index')
            ->with('orders', $action->run());
    }

    /**
     * @param GetOrderByIdAction $action
     * @param integer $id
     * @return Factory|View
     */
    public function show(GetOrderByIdAction $action, $id)
    {
        return view('admin.order.revision')
            ->with('order', $action->run($id));
    }

    /**
     * @param DeleteAction $action
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(DeleteAction $action, $id)
    {
        $action->run($id);
        return redirect()->route('admin.order.index')->with('success', 'Замовлення успішно видалено');
    }

    /**
     * @param EditOrderAction $action
     * @param integer $id
     * @return Factory|View
     */
    public function edit(EditOrderAction $action, $id)
    {
        return view('admin.order.edit', $action->run($id));
    }


    /**
     * @param UpdateAction $action
     * @param OrderRequest $request
     * @param int $orderId
     * @return RedirectResponse
     */
    public function update(UpdateAction $action, OrderRequest $request, $orderId)
    {
        $action->run($request, $orderId);
        return redirect()->back()->with('success', 'Замовлення успішно змінено');
    }

    /**
     * Зміна статусу замовлення
     * @param UpdateOrderStatusAction $action
     * @param StatusOrderRequest $request
     * @param integer $orderId
     * @return RedirectResponse
     */
    public function updateStatus(UpdateOrderStatusAction $action, StatusOrderRequest $request, $orderId)
    {
        $action->run($request, $orderId);
        return redirect()->back()->with('success', 'Статус замовлення успішно змінений');
    }
}
