<?php

namespace App\Rules;

use App\Services\Shipping\ShippingBase;
use App\Shipping;
use Illuminate\Contracts\Validation\Rule;

class ShippingCityRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $shippingBase = new ShippingBase(Shipping::$shipping_methods, 'novaposhta');
        return $shippingBase->existCity($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Dont find the city ref';
    }
}
