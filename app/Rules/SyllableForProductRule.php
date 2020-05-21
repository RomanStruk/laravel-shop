<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SyllableForProductRule implements Rule
{
    private $products;

    /**
     * Create a new rule instance.
     *
     * @param $products
     */
    public function __construct($products)
    {
        //
        $this->products = $products;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $var = explode('.', $attribute);
        $keyForProducts = $var[1];
        $element = $this->products[$keyForProducts];
//        dump($var, $keyForProducts, $this->products, $attribute, $value);

        if (! \DB::table('syllables')->where('id', '=', (int)$value)->where('product_id', '=', (int)$element['id'])->exists()) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Поставка не відповідає товару';
    }
}
