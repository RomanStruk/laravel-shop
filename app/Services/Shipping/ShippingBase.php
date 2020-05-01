<?php


namespace App\Services\Shipping;


use App\Services\Shipping\ShippingDriver\NovaPoshtaDriver;
use App\Services\Shipping\ShippingMethods\ShippingMethodInterface;
use App\Services\Shipping\Utils\Address;
use App\Services\Shipping\Utils\City;

class ShippingBase
{
    public $shipping_methods = [];

    public $address;

    public $city;

    private $driver = NovaPoshtaDriver::class; // драйвер для пошуку

    private $current_method;

    /**
     * ShippingBase constructor.
     * @param array $shipping_methods
     * @param $current_method
     */
    public function __construct(array $shipping_methods, $current_method)
    {
        foreach ($shipping_methods as $name => $shipping_method) {
            $class = new $shipping_method(new $this->driver);
            if ($class instanceof ShippingMethodInterface)
                $this->shipping_methods[$name] = $class;
        }
        $this->current_method = $current_method;
    }


    public function listAvailableCities(string $search): array
    {
        return $this->shipping_methods[$this->current_method]->findCity($search);
    }

    public function listAvailableAddresses(string $cityCode): array
    {
        return $this->shipping_methods[$this->current_method]->findAddress($cityCode);
    }


    public function existCity($cityCode)
    {
        return $this->shipping_methods[$this->current_method]->existCity($cityCode);
    }

    public function existAddress($addressCode)
    {
        return$address = $this->shipping_methods[$this->current_method]->existAddress($this->city->code, $addressCode);
    }

    public function setCity($cityCode)
    {
        $this->city = $this->existCity($cityCode)? : new City($cityCode, $cityCode);
        return $this;
    }

    public function cityFillDataForSave()
    {
        return [
            'code' => $this->city->code,
            'title' => $this->city->title,
            'description' => $this->city->description,
        ];
    }

    public function setAddress($addressCode)
    {
        $this->address = $this->existAddress($addressCode)? : new Address($addressCode, $addressCode);
        return $this;
    }

    public function addressFillDataForSave()
    {
        return [
            'code' => $this->address->code,
            'title' => $this->address->title,
        ];
    }

    public static function castCity(array $city)
    {
        $castCity = new City($city['code'], $city['title']);
        $castCity->description = $city['description'];
        return $castCity;
    }

    public static function castAddress(array $address)
    {
        return new Address($address['code'], $address['title']);
    }

}