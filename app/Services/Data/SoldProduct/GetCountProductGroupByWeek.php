<?php


namespace App\Services\Data\SoldProduct;


use App\SoldProduct;

class GetCountProductGroupByWeek
{
    public function handel($productId): array
    {
//select product_id, week(created_at), count(*) as c from sold_products WHERE product_id=8 group by product_id, week(created_at)
        $product = SoldProduct::select(
            ['product_id', \DB::raw("week(created_at)"), \DB::raw("COUNT(*) as c")]
        )
            ->where('product_id', $productId)
            ->groupBy('product_id', 'week(created_at)')
            ->get();
        $volumePeriods = [];
        foreach ($product as $item){
            $volumePeriods[] = $item->c;
        }
        return $volumePeriods;
    }
}
