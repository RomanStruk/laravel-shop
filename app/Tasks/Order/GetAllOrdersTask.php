<?php


namespace App\Tasks\Order;


use App\Order;
use App\Repositories\ScopeFilters\BaseFilter;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

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

    public function get(Request $request)
    {
        $orders = $this->repository->getAllWithRelationships();
//        $orders = Order::with('products');
//        $orders = (new BaseFilter($orders, $request))->apply()->get();
        $orders->map(function ($order) {
//            $order->detail_status = $this->repository->getOrderStatus($order);
            $order->sum_price = $order->products->sum('price');
            return $order;
        });
        return $orders;
    }
}
