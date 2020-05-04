<?php


namespace App\Services\Shipping\Utils;


class City
{
    public $code;
    public $title;
    /**
     * @var string
     */
    public $description;

    /**
     * City constructor.
     * @param $code
     * @param $title
     */
    public function __construct($code, $title)
    {
        $this->code = $code;
        $this->title = $title;
    }
}