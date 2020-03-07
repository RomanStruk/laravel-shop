<?php


namespace App\Tasks\Order;


use App\Repositories\OrderRepository;

class GetAllOrdersTask
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

    public function get()
    {
        $orders = $this->repository->getAllWithRelationships();
        $orders->map(function ($order) {
//            $order->detail_status = $this->repository->getOrderStatus($order);
            $order->sum_price = $order->products->sum('price');
            return $order;
        });
        return $orders;
    }
}
