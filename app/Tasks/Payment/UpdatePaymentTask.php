<?php


namespace App\Tasks\Payment;


use App\Payment;
use App\Repositories\PaymentRepository;

class UpdatePaymentTask
{
    /**
     * @var PaymentRepository
     */
    private $repository;

    /**
     * OrderTasks constructor.
     */
    public function __construct()
    {
        $this->repository = PaymentRepository::getInstance();
    }

    public function update(Payment $payment, $input)
    {
        return $payment->update($input);
    }
}
