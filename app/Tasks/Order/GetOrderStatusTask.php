<?php


namespace App\Tasks\Order;


use App\Order;
use App\Repositories\OrderRepository;
use Illuminate\Support\Collection;

class GetOrderStatusTask
{
    /**
     * @var OrderRepository
     */
    private $repository;

    /**
     * OrderTasks constructor.
     */
    public function __construct()
    {
        $this->repository = OrderRepository::getInstance();
    }

    /**
     * @return Collection
     */
    public function get()
    {
//        if ($order instanceof Order)
        return $this->repository->getOrderStatus();
    }
}
