<?php


namespace App\Services\Shipping\ShippingMethods;

use App\Services\Shipping\Utils\Address;
use App\Services\Shipping\Utils\City;

class NovaPoshtaMethod implements ShippingMethodInterface
{
    private $driver;

    /**
     * NovaPoshtaMethod constructor.
     * @param $driver
     */
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

    /**
     * @param $search
     * @return array
     */
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
        $result = $this->driver->findAddressByCityCode($cityCode);
        $return = [];
        foreach ($result['data'] as $value) {
            $address = new Address($value['Ref'], $value['Description']);
            $address->address = $value['ShortAddress'];
            $address->phone = $value['Phone'];
            $return[] = $address;
        }
        return $return;
    }


    public function existCity($cityCode)
    {
        $result = $this->driver->findCityByCode($cityCode);

        if (count($result['data']) == 0) return false;

        return $this->parseResult($result['data'][0]);
    }

    public function existAddress($cityCode, $addressCode)
    {
        $addresses = $this->findAddress($cityCode);
        foreach ($addresses as $address) {
            if ($address->code == $addressCode)
                return $address;
        }
        return false;
    }

}