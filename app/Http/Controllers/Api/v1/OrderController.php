<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\OrderCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Services\Shipping\ShippingBase;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return Response
     */
    public function store(OrderRequest $request)
    {
//        return response()->json(['request' => $request->validated()]);

        try {
            $order = new Order($request->orderFillData());
            auth()->user()->orders()->save($order);

            // sync products
            $order->saveProducts($request->productsFillData());

            //create payment information
            $order->paymentCreate($request->paymentFillData());

            // create shipping information
            $shipping = $request->shippingFillData();
            $shippingBase = new ShippingBase(Shipping::$shipping_methods, $shipping['method']);
            $shipping['shipping_rate'] = 50;
            $shipping['city'] = $shippingBase->setCity($shipping['city'])->cityFillDataForSave();
            $shipping['address'] = $shippingBase->setAddress($shipping['address'])->addressFillDataForSave();
            $order->shippingCreate($shipping);

            // event
            event(new OrderCreatedEvent($order));
            return response([
                'id' => $order->id,
                'status' => $order->getStatus(Order::STATUS_PENDING),
            ], Response::HTTP_CREATED);
//            Response::HTTP_CREATED
        }catch (\Exception $exception){
            return response(['message' => $exception->getMessage()], 500);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
