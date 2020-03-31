<?php


namespace App\Services\Data\Shipping;


use App\Services\Shipping\ShippingNovaposhta;
use Exception;

class GetWarehousesByCityRef
{
    public function handel($cityRef)
    {
        $shipping = new ShippingNovaposhta();

        $result = $shipping->findWarehouses($cityRef);

        if (count($result->errors)>=1) throw new Exception($result->errors);

        if ($result->info->totalCount == 0) return [];

        $data = [];
        foreach ($result->data as $item) {
            $data[$item->Ref] = $item;
        }
        return $data;
    }
}
