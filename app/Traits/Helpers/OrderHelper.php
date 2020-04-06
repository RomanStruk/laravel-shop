<?php


namespace App\Traits\Helpers;


use Str;

/**
 * @property-read \App\Payment $payment
 */
trait OrderHelper
{
    public function syncProducts(array $products)
    {
        return $this->products()->sync($products);
    }

    public function paymentUpdate(array $fields)
    {
//        $a = array_intersect_key($fields, array_flip($this->payment->fillable));
        return $this->payment()->update($fields);
    }

    public function shippingUpdate(array $fields)
    {
        return $this->shipping()->update($fields);
    }
}
