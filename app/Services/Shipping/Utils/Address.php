<?php


namespace App\Services\Shipping\Utils;


class Address
{
    public $title;
    public $code;

    /**
     * Address constructor.
     * @param $code
     * @param $title
     */
    public function __construct($code, $title)
    {
        $this->code = $code;
        $this->title = $title;
    }
}