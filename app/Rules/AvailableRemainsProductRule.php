<?php

namespace App\Rules;

use App\Syllable;
use Illuminate\Contracts\Validation\Rule;

class AvailableRemainsProductRule implements Rule
{
    private $products;
    /**
     * @var null
     */
    private $order;

    /**
     * Create a new rule instance.
     *
     * @param $products
     * @param null $order
     */
    public function __construct($products, $order = null)
    {
        //
        $this->products = $products;
        $this->order = $order;
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
        $var = explode('.', $attribute);
        $keyForProducts = $var[1];
        $element = $this->products[$keyForProducts];

        // пошук доступної кількості товарів не включаючи замовлення яке редактується
        $Syllable = Syllable::countAvailableRemains($this->order)->find($value);

        // перевірка
        return $Syllable->countAvailableRemains - $element['count'] >= 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Вказана кількість товару не відповідає наявному';
    }
}
