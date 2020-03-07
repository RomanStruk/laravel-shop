<?php


namespace App\Actions\Order;


use App\Http\Requests\OrderRequest;
use App\Tasks\Order\FindOrderByIdTask;
use App\Tasks\Order\UpdateProducts;
use App\Tasks\Payment\UpdatePaymentTask;
use App\Tasks\User\UpdateUserDetailTask;

class UpdateAction
{

    /**
     * Update order
     * @param OrderRequest $request
     * @param $id
     */
    public function run(OrderRequest $request, $id)
    {
//        $order = $this->orderRepository->find($id);
        $order = (new FindOrderByIdTask())->get($id)->first();

        $userUpdated = (new UpdateUserDetailTask())->update($order->user, $request->only(['first_name', 'last_name', 'phone']));
        $productsUpdated = (new UpdateProducts())->update($order, $request->input(['products']));
        $paymentUpdated = (new UpdatePaymentTask())->update($order->payment, [
            'paid' => $request->input(['paid']),
            'method' => $request->input(['method_pay']),
        ]);
                dd($userUpdated, $productsUpdated, $paymentUpdated);
        return;
//        $this->userRepository->updateDetail($order->user, $request->only(['first_name', 'last_name', 'phone']));

//        $this->orderRepository->updateProducts($order, $request->input(['products']));
        $this->paymentRepository->update($order->payment, [
            'paid' => $request->input(['paid']),
            'method' => $request->input(['method_pay']),
        ]);
        $this->shippingRepository->update($order->shipping, [
            'method' => $request->input('shipping_method'),
            'street' => $request->input('street'),
            'house' => $request->input('house'),
            'flat' => $request->input('flat'),
            'warehouse_ref' => $request->input('warehouse_ref'),
            'city_ref' => $request->input('city_ref'),
        ]);
    }
}
