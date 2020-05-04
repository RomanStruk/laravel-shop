<?php

namespace Tests\Feature;

use App\Order;
use App\Services\Shipping\ShippingBase;
use App\Services\Shipping\ShippingDriver\NovaPoshtaDriver;
use App\Services\Shipping\ShippingMethods\CourierMethod;
use App\Services\Shipping\ShippingMethods\NovaPoshtaMethod;
use App\Services\Shipping\Utils\Address;
use App\Services\Shipping\Utils\City;
use App\Shipping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShippingTest extends TestCase
{

    public function test_save_shipping_method_nv()
    {
        $array_request = [
            'method' => 'novaposhta',
            'shipping_rate' => 10,
            'city' => 'e718a680-4b33-11e4-ab6d-005056801329',
            'address' => '7b422fc3-e1b8-11e3-8c4a-0050568002cf',
        ];

        // реєстрація варіантів доставки
        $shippingBase = new ShippingBase(Shipping::$shipping_methods, $array_request['method']);

        $shipping = new Shipping();
        $shipping->method   = $array_request['method'];
        $shipping->shipping_rate   = $array_request['shipping_rate'];

        $shipping->city     = $array_request['city'];
        $shipping->address  = $array_request['address'];

        $this->assertTrue(true);
        dd($shipping);
    }

    public function test_save_shipping_method_cr()
    {
        $array_request = [
            'method' => 'courier',
            'shipping_rate' => 10,
            'city' => 'e718a680-4b33-11e4-ab6d-005056801329',
            'address' => 'вул. Вільхівка 21',
        ];

        // реєстрація варіантів доставки
        $shippingBase = new ShippingBase(Shipping::$shipping_methods, $array_request['method']);

        $shipping = new Shipping();
        $shipping->method   = $array_request['method'];
        $shipping->shipping_rate   = $array_request['shipping_rate'];

        $shipping->city     = $array_request['city'];
        $shipping->address  = $array_request['address'];

        $this->assertTrue(true);
        dd($shipping);
    }

    public function test_cast_city()
    {
        $city = ShippingBase::castCity(['code' => '123123123', 'title' => 'some city']);
        $address = ShippingBase::castAddress(['code' => '123123123', 'title' => 'some warehouse']);

        $this->assertTrue(true);
        dd($city, $address);
    }
}
