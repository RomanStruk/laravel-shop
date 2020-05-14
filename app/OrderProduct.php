<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function foo\func;

class OrderProduct extends Model
{
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * @return BelongsTo
     */
    public function syllable()
    {
        return $this->belongsTo(Syllable::class);
    }


    /**
     *
     * Calculated sum price for one product
     *
     * @return float|int
     */
    public function getTotalPriceForProduct()
    {
        return $this->product->price * $this->count;
    }

    public function scopeSold(Builder $query, $range)
    {
        return $query->whereHas('order', function ($builder) use ($range) {
            $builder->where('status', '=', Order::STATUS_COMPLETED);
            if ($range) $builder->whereBetween('created_at', $range);
        });

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


    /**
     * Scope a query CountProductGroupByWeek
     * select product_id, week(created_at), count(*) as c from sold_products WHERE product_id=8 group by product_id, week(created_at)
     *
     * select order_products.product_id, week(created_at), SUM(order_products.count) as c from orders, order_products WHERE order_products.product_id=1 and orders.status=3 AND order_products.order_id=orders.id group by order_products.product_id, week(created_at)
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeCountProductGroupByWeek($query)
    {
        return  $query->select([
            'product_id',

            \DB::raw("COUNT(*) as c"),
            'week(created_at)' => function ($query){
                $query->select(\DB::raw("week(created_at)"))->from('orders');
            }
        ])->groupBy('product_id', 'week(created_at)');
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
}
