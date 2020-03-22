<?php


namespace App\Tasks\Shipping;


use App\Shipping;

class UpdateShippingTask
{
    public function update(Shipping $shipping, $input)
    {
        return $shipping->update($input);
    }
}
