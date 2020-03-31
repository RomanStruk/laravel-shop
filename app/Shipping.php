<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Shipping
 *
 * @property int $id
 * @property int $order_id
 * @property string $method
 * @property float $shipping_rate
 * @property string $city
 * @property string $region
 * @property string $area
 * @property string $city_ref
 * @property string|null $street
 * @property int|null $house
 * @property int|null $flat
 * @property string|null $warehouse_ref
 * @property-read \App\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereCityRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereShippingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereWarehouseRef($value)
 * @mixin \Eloquent
 * @property string|null $warehouse_title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereWarehouseTitle($value)
 */
class Shipping extends Model
{
    public $timestamps = false;
    public $fillable = [
        'method',
        'shipping_rate',
        'city',
        'region',
        'area',
        'city_ref',
        'street',
        'house',
        'flat',
        'warehouse_ref',
        'warehouse_title',
    ];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function getShippingRateAttribute($value)
    {
        return round(($value/100), 2);
    }
    public function setShippingRateAttribute($value)
    {
        $this->attributes['shipping_rate'] = (int)((float)$value*100);
    }
}
