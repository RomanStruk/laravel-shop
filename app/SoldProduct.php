<?php

namespace App;

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

}
