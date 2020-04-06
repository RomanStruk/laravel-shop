<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Shipping\ShippingInterface;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    private $shipping;

    /**
     * ShippingController constructor.
     * @param ShippingInterface $shipping
     */
    public function __construct(ShippingInterface $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @param $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCity($city)
    {
        return response()->json(
            $this->shipping->findCity($city)
        );
    }

    /**
     * @param $cityRef
     * @return \Illuminate\Http\JsonResponse
     */
    public function showWarehouse($cityRef)
    {
        return response()->json(
            $this->shipping->findWarehouses($cityRef)
        );
    }


}
