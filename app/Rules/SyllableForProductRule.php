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
//        if ($keyForProducts != 0)
//            dd($var, $keyForProducts, $this->products, $attribute, $value);
        $element = $this->products[$keyForProducts];

        if (! array_key_exists('id', $element )) return true;

        if (! array_key_exists('syllable', $element)) return false;
        if (! \DB::table('syllables')->where('id', '=', (int)$element['syllable'])->where('product_id', '=', (int)$element['id'])->exists()) {
            return false;
        }
//        foreach ($this->products as $element) {
//
//
//        }
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
