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
     */
    public function get($cityRef)
    {
        try {
            return $this->repository->getParserWarehouses($cityRef);
        } catch (Exception $exception) {

        }
    }
}
