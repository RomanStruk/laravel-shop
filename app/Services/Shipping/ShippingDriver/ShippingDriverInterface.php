<?php


namespace App\Services\Shipping\ShippingDriver;


interface ShippingDriverInterface
{
    public function findCityByName($cityName);
    public function findCityByCode($ref);
    public function findAddressByCityCode($cityRef);
}