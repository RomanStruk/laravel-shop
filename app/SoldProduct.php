<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\SoldProduct
 *
 * @property int $id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $sale_price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct countProductGroupByWeek()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct salesOverTime()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SoldProduct top($limit)
 */
class SoldProduct extends Model
{
    protected $fillable = ['product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSalePriceAttribute($value)
    {
        return $value;
//        return round(($value/100), 2);
    }
    public function setSalePriceAttribute($value)
    {
        $this->attributes['sale_price'] = (int)((float)$value*100);
    }


    /**
     * Scope a query CountProductGroupByWeek
     * select product_id, week(created_at), count(*) as c from sold_products WHERE product_id=8 group by product_id, week(created_at)
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeCountProductGroupByWeek($query)
    {
        return  $query->select(['product_id', \DB::raw("week(created_at)"), \DB::raw("COUNT(*) as c")])
            ->groupBy('product_id', 'week(created_at)');
    }

    /**
     * Scope a SalesOverTime
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeSalesOverTime($query)
    {
        return $query->select(\DB::raw("SUM(sale_price) AS sale_price_sum"));
    }

    /**
     * Scope a top
     *
     * @param Builder $query
     * @param $limit
     * @return Builder
     */
    public function scopeTop($query, int $limit)
    {
        return  $query
            ->with('product')
            ->select(['product_id', \DB::raw("COUNT(*) as c")])
            ->groupBy('product_id')
            ->orderByDesc('c')
            ->limit($limit);
    }
}
