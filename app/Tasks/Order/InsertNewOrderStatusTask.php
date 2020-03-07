<?php


namespace App\Tasks\Order;


use App\OrderDetail;
use App\Repositories\OrderRepository;

class InsertNewOrderStatusTask
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

    public function insert($orderId, $input)
    {
        $order = $this->repository->find($orderId);
        return $order->details()->save(new OrderDetail($input));
    }
}
