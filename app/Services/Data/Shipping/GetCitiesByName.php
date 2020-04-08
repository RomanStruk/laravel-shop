<?php


namespace App\Services\Data\Shipping;


use App\Services\Shipping\ShippingInterface;
use Exception;

class GetCitiesByName
{
    /**
     * @var ShippingInterface
     */
    private $shipping;

    /**
     * GetWarehousesByCityRef constructor.
     * @param ShippingInterface $shipping
     */
    public function __construct(ShippingInterface $shipping)
    {
        $this->shipping = $shipping;
    }

    public function handel($cityName)
    {

        $cities = $this->shipping->findCity($cityName);

        if (count($cities['errors'])>=1) throw new Exception($cities->errors);;
        if ($cities['info']['totalCount'] == 0) throw new Exception('Error totalCount = 0');

        return $cities->data;
    }
}
