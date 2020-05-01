<?php


namespace App\Services\Shipping\ShippingMethods;


use App\Services\Shipping\Utils\Address;
use App\Services\Shipping\Utils\City;

interface ShippingMethodInterface
{
    public function findCity($search): array;
    public function findAddress($cityCode): array;
    public function existCity($cityCode);
    public function existAddress($cityCode, $addressCode);
}