<?php


namespace App\Services\Data\Product;


use App\Product;

class CreateProductService
{
    public function handel($input)
    {
        $product = new Product($input);
        $product->save();
        return $product;
    }
}
