<?php


namespace App\Services\Data\SoldProduct;


use App\SoldProduct;

class salesOverTime
{
    public function handel()
    {
        return round(SoldProduct::select(\DB::raw("SUM(sale_price) AS sale_price_sum"))->first()->sale_price_sum/100, 2);
    }
}
