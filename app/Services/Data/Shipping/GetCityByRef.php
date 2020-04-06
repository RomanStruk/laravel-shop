<?php


namespace App\Services\Data\Shipping;


use App\Services\Shipping\ShippingInterface;
use Exception;

class GetCityByRef
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

    public function handel($cityRef)
    {

        $result = $this->shipping->findRef($cityRef);
        if (count($result->errors)>=1) throw new Exception($result->errors);;
        if ($result->info->totalCount <> 1) throw new Exception('totalCount <> 1');
        $data = [];
        foreach ($result->data[0] as $key => $value){
            $data[$key] = $value;
        }
        return $data;
    }
}
