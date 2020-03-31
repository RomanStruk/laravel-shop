<?php


namespace App\Services\Data\Order;


use App\Order;
use App\Services\PaginateSession;
use App\Services\ScopeFilters\OrdersFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetOrdersByLimit
{
    /**
     * @var OrdersFilter
     */
    private $ordersFilter;
    /**
     * @var PaginateSession
     */
    private $paginateSession;

    /**
     * GetProductsByLimit constructor.
     * @param OrdersFilter $ordersFilter
     * @param PaginateSession $paginateSession
     */
    public function __construct(OrdersFilter $ordersFilter, PaginateSession $paginateSession)
    {
        $this->ordersFilter = $ordersFilter;
        $this->paginateSession = $paginateSession;
    }

    /**
     * @param $filters
     * @param array $fields
     * @return LengthAwarePaginator
     */
    public function handel($filters, $fields = ['*'])
    {
        $limit = $this->paginateSession->getLimit();

        $orders = Order::filter($this->ordersFilter, $filters)
            ->with('products')
            ->with('products.category')
            ->with('user')
            ->with('user.detail')
            ->with('details')
            ->with('payment')
            ->with('shipping');;
        $orders = $orders->paginate($limit);

        $orders->map(function ($order) {
            $order->sum_price = $order->products->sum('price');
            return $order;
        });
        $orders->map(function ($order) {
            return $order->detail_status = $order->details->sortByDesc('date_added')->first()->status;
        });

        return $orders;
    }
}
