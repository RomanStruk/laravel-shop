<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\OrderProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $order_id
 * @property int $syllable_id
 * @property int $count
 * @property int $sale_price
 * @property-read mixed $sale_price_sum
 * @property-read \App\Order $order
 * @property-read \App\Product $product
 * @property-read \App\Syllable $syllable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct countProductGroupByWeek()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct salesOverTime()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct sold($range)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct top($limit)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderProduct whereSyllableId($value)
 * @mixin \Eloquent
 */
class OrderProduct extends Model
{
    public $timestamps = false;

    protected $fillable = ['product_id', 'order_id', 'syllable_id', 'count', 'sale_price'];

    /**
     * Відношення до замовлення
     *
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Відношення до товару
     *
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Відношення до конкретної поставки
     *
     * @return BelongsTo
     */
    public function syllable()
    {
        return $this->belongsTo(Syllable::class);
    }

    public function getSalePriceAttribute($value)
    {
        return round(($value / 100), 2);
    }

    public function getSalePriceSumAttribute($value)
    {
        return round(($value / 100), 2);
    }

    public function setSalePriceAttribute($value)
    {
        $this->attributes['sale_price'] = (int)((float)$value * 100);
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


    /**
     * Видір тільки тих товарів що мають статус "завершений"
     * @param Builder $query
     * @param $range
     * @return Builder
     */
    public function scopeSold(Builder $query, $range)
    {
        return $query->whereHas('order',
            function ($builder) use ($range) {
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
        return $query
            ->with('product')
            ->select(['product_id', DB::raw("SUM(count) as c")])
            ->whereHas('order', function ($query) {
                $query->where('status', '=', Order::STATUS_COMPLETED);
            })
            ->groupBy('product_id')
            ->orderByDesc('c')
            ->limit($limit);
    }


    /**
     * Scope a query CountProductGroupByWeek
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeCountProductGroupByWeek($query)
    {
        return $query
            ->select([
                DB::raw("SUM(order_products.count) as count_sold"),
                'product_id',
                DB::raw('week(orders.created_at)')
            ])
            ->rightJoin('orders', function ($query) {
                $query->on('orders.id', '=', 'order_products.order_id')->where('orders.status', '=', Order::STATUS_COMPLETED);
            })
            ->where('product_id', '=', $this->product_id)
            ->groupBy(DB::raw('week(orders.created_at)'), 'product_id');
    }

    /**
     * Scope a SalesOverTime
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeSalesOverTime($query)
    {
        return $query
            ->select(DB::raw("SUM(sale_price*count) AS sale_price_sum"))
            ->whereHas('order', function ($builder) {
                $builder->where('status', '=', Order::STATUS_COMPLETED);
            });
    }
}
