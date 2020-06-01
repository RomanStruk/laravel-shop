<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchShippingCity;
use App\Services\Shipping\ShippingBase;
use App\Services\Shipping\ShippingMethods\CourierMethod;
use App\Services\Shipping\ShippingMethods\NovaPoshtaMethod;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    private $shipping;

    public function __construct()
    {
        $this->shipping = [
            'novaposhta' => NovaPoshtaMethod::class,
            'courier' => CourierMethod::class,
        ];
    }

    public function listOfCities(Request $request)
    {
        $request->validate(['shipping_method' => 'required','title' => 'required']);
        $shippingBase = new ShippingBase($this->shipping, $request->shipping_method);
        return response($shippingBase->listAvailableCities($request->title));
    }

    public function listOfAddresses(Request $request)
    {
        $request->validate(['shipping_method' => 'required','code' => 'required']);
        $shippingBase = new ShippingBase($this->shipping, $request->shipping_method);
        return response($shippingBase->listAvailableAddresses($request->code));
    }

}
