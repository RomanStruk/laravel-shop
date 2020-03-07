<?php


namespace App\Tasks\Order;


use App\Order;
use App\Repositories\OrderRepository;

class UpdateProducts
{
    /**
     * @var OrderRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = OrderRepository::getInstance();
    }

    public function update(Order $order, $input)
    {
        return $order->products()->sync($input);
    }
}
