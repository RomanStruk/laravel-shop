<?php


namespace App\Services\Data\SoldProduct;


use App\SoldProduct;

class GetSoldProductsBetweenDate
{
    public function handel( array $range, bool $count = false)
    {
        $sold = SoldProduct::whereBetween('created_at', $range);
        if ($count)
            return $sold->count();
        return $sold->get();
    }
}
