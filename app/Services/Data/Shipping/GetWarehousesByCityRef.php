<?php


namespace App\Services\Data\Shipping;


use App\Services\Shipping\ShippingInterface;
use Exception;

class GetWarehousesByCityRef
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

        $result = $this->shipping->findWarehouses($cityRef);

        if (count($result->errors)>=1) throw new Exception($result->errors);

        if ($result->info->totalCount == 0) return [];

        $data = [];
        foreach ($result->data as $item) {
            $data[$item->Ref] = $item;
        }
        return $data;
    }
}
