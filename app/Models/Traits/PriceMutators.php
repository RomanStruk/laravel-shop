<?php


namespace App\Models\Traits;


trait PriceMutators
{

    /**
     *
     * Геттер для отримання ціни товару копійки в грн
     *
     * @param $value
     * @return false|float
     */
    public function getPriceAttribute($value)
    {
        return round(($value/100), 2);
    }

    /**
     *
     * Сеттер для внесення ціни товару копійки
     *
     * @param $value
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (int)((float)$value*100);
    }

    /**
     *
     * Геттер для отримання старої ціни товару копійки в грн
     *
     * @param $value
     * @return false|float
     */
    public function getOldPriceAttribute($value)
    {
        return round(($value/100), 2);
    }

    /**
     *
     * Сеттер для внесення старої ціни товару копійки
     *
     * @param $value
     */
    public function setOldPriceAttribute($value)
    {
        $this->attributes['old_price'] = (int)((float)$value*100);
    }

}
