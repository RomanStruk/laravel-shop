<?php


namespace App\Services;


use App\Http\Requests\OrderRequest;
use App\Http\Requests\StatusOrderRequest;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\Repository;
use App\Repositories\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\ShippingRepository;
use App\Repositories\UserRepository;
use App\Tasks\Order\FindOrderByIdTask;
use App\Tasks\Order\OrderTasks;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var ShippingRepository
     */
    private $shippingRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(ShippingRepository $shippingRepository,
                                UserRepository $userRepository,
                                PaymentRepository $paymentRepository)
    {
        $this->orderRepository = OrderRepository::getInstance();
        $this->shippingRepository = $shippingRepository;
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
    }



}
