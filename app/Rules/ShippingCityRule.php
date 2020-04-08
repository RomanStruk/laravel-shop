<?php

namespace App\Rules;

use App\Services\Shipping\ShippingInterface;
use Illuminate\Contracts\Validation\Rule;

class ShippingCityRule implements Rule
{
    private $shipping;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->shipping = $api = resolve(ShippingInterface::class);;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = $this->shipping->findRef($value);
        if (count($result['errors'])>=1) return false;
        if ($result['info']['totalCount'] <> 1) return false;
//        dd($result);
        return $result['data'][0]['Ref'] == $value;
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
