<?php


namespace App\Actions\Order;


use App\Http\Requests\OrderRequest;
use App\Tasks\Order\FindOrderByIdTask;
use App\Tasks\Order\UpdateProducts;
use App\Tasks\Payment\UpdatePaymentTask;
use App\Tasks\Shipping\GetCityByRefTask;
use App\Tasks\Shipping\GetWarehousesByCityRef;
use App\Tasks\Shipping\UpdateShippingTask;
use App\Tasks\User\UpdateUserDetailTask;

class UpdateOrderAction
{

    /**
     * Update order
     * @param OrderRequest $request
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function run(OrderRequest $request, $id)
    {
        $order = (new FindOrderByIdTask())->get($id)->first();
        $userUpdated = (new UpdateUserDetailTask())->update($order->user, $request->only(['first_name', 'last_name', 'phone']));
        $productsUpdated = (new UpdateProducts())->update($order, $request->input(['products']));
        $paymentUpdated = (new UpdatePaymentTask())->update($order->payment, [
            'paid' => $request->input(['paid']),
            'method' => $request->input(['method_pay']),
        ]);

        $inputShipping = [
            'method' => $request->input('shipping_method'),
            'street' => $request->input('street'),
            'house' => $request->input('house'),
            'flat' => $request->input('flat'),
            'warehouse_ref' => $request->input('warehouse_ref'),
            'city_ref' => $request->input('city_ref'),
        ];
        if ($order->shipping->city_ref != $inputShipping['city_ref']){
            $cityInformation = (new GetCityByRefTask())->get($inputShipping['city_ref']);
            $inputShipping['city_ref'] = $cityInformation['Ref'];
            $inputShipping['city'] = $cityInformation['SettlementTypeDescription'].$cityInformation['Description'];
            $inputShipping['region'] = $cityInformation['RegionsDescription'];
            $inputShipping['area'] = $cityInformation['AreaDescription'];
        }elseif ($inputShipping['method'] == 'novaposhta'){

            $warehouses = (new GetWarehousesByCityRef())->get($inputShipping['city_ref']);
            $inputShipping['warehouse_title'] = 'Don`t choose';
            if (key_exists('warehouse_ref', $warehouses)){
                $inputShipping['warehouse_title'] = $warehouses[$inputShipping['warehouse_ref']]->Description;
            }
        }
        $shippingUpdated = (new UpdateShippingTask())->update($order->shipping, $inputShipping);
//        dd($userUpdated, $productsUpdated, $paymentUpdated,$shippingUpdated);
        return true;

    }
}
