<?php


namespace App\Services\Data\SoldProduct;


use App\SoldProduct;

class GetTopProductsByLimit
{
    public function handel($limit)
    {

        $products = SoldProduct::select(['product_id', \DB::raw("COUNT(*) as c")])
        ->groupBy('product_id')->orderByDesc('c')->limit($limit)->get();
        $products = $products->load('product');
        return $products;
    }
}
