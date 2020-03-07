<?php


namespace App\Repositories;


use App\Payment;

class PaymentRepository extends Repository
{
    public function update(Payment $payment, $input)
    {
        $payment->update($input);
    }
}
