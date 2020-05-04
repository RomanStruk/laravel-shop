<?php


namespace App\Services\Data\SoldProduct;


use App\SoldProduct;

class GetSoldProductBetweenDate
{
    public function handel($productId, array $range, bool $count = false)
    {
        $sold = SoldProduct::where('product_id', '=', $productId)
            ->whereBetween('created_at', $range);
        if ($count)
            return $sold->count();
        return $sold->get();
    }
}
