<?php


namespace App\Services\Shipping;


interface ShippingInterface
{
    public function findCity($cityName);
    public function findRef($ref);
    public function findWarehouses($cityRef);
}
