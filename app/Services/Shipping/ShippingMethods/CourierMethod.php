<?php


namespace App\Services\Shipping\ShippingMethods;

use App\Services\Shipping\Utils\Address;
use App\Services\Shipping\Utils\City;

class CourierMethod implements ShippingMethodInterface
{

    private $driver;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    private function parseResult($value): City
    {
        $city = new City($value['Ref'], $value['Description']);
        $city->description = $value['Description']. ' '.$value['RegionsDescription']. ' '.$value['AreaDescription'];
        return $city;
    }

    public function findCity($search): array
    {
        $result = $this->driver->findCityByName($search);
        $return = [];
        foreach ($result['data'] as $value) {
            $return[] = $this->parseResult($value);
        }
        return $return;
    }

    public function findAddress($cityCode): array
    {
        return [];
    }

    public function existCity($cityCode)
    {
        $result = $this->driver->findCityByCode($cityCode);

        foreach ($result['data'] as $value) {
            return $this->parseResult($value);
        }
        return false;
    }

    public function existAddress($cityCode, $addressCode)
    {
        return new Address($addressCode, $addressCode);
    }
}