<?php

namespace App\Tasks\Order;

use App\Repositories\OrderRepository;

class FindOrderByIdTask
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

    public function get($id)
    {
        return $this->repository->getOrderWithRelationships($id);
    }

}
