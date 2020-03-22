<?php


namespace App\Tasks\Shipping;


use App\Repositories\ShippingRepository;
use Exception;

class GetWarehousesByCityRef
{
    /**
     * @var ShippingRepository
     */
    private $repository;

    /**
     * OrderTasks constructor.
     */
    public function __construct()
    {
        $this->repository = ShippingRepository::getInstance();
    }

    /**
     * Get warehouses of city
     * @param $cityRef
     * @return array|bool
     * @throws Exception
     */
    public function get($cityRef)
    {
        $result = $this->repository->findWarehouses($cityRef);

        if (count($result->errors)>=1) throw new Exception($result->errors);

        if ($result->info->totalCount == 0) return [];

        $data = [];
        foreach ($result->data as $item) {
            $data[$item->Ref] = $item;
        }
        return $data;

    }
}
