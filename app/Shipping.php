<?php

namespace App;

use App\Services\Shipping\ShippingBase;
use App\Services\Shipping\ShippingMethods\CourierMethod;
use App\Services\Shipping\ShippingMethods\NovaPoshtaMethod;
use App\Traits\Helpers\SerializeDate;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Shipping
 *
 * @property int $id
 * @property int $order_id
 * @property string $method
 * @property float $shipping_rate
 * @property array $city
 * @property array|null $address
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
 * @property string $city_code
 * @property string|null $warehouse_code
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Shipping whereWarehouseCode($value)
 */
class Shipping extends Model
{
    use SerializeDate;

    public $timestamps = false;
    public $fillable = [
        'method',
        'shipping_rate',
        'city_code',
        'street',
        'house',
        'flat',
        'warehouse_code',
    ];


    protected $casts = [
        'city' => 'array',
        'address' => 'array'
    ];

    public static $shipping_methods = [
        'novaposhta' => NovaPoshtaMethod::class,
        'courier' => CourierMethod::class,
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function getShippingRateAttribute($value)
    {
        return round(($value / 100), 2);
    }

    public function setShippingRateAttribute($value)
    {
        $this->attributes['shipping_rate'] = (int)((float)$value * 100);
    }

    ////////////////////////////////
    ///
    /// ///////////////////////////



    public function getCityTitle()
    {
        $city = ShippingBase::castCity($this->city);
        return $city->description;

    }

    public function getAddressTitle()
    {
        $address = ShippingBase::castAddress($this->address);
        return $address->title;
    }

    public function getCity()
    {
        return ShippingBase::castCity($this->city);
    }

    public function getAddress()
    {
        return ShippingBase::castAddress($this->address);
    }

    /**
     *
     * Переторення даних для збереження в ДБ
     *
     * @param $value
     */
    public function setCityAttribute($value)
    {
//        $shippingBase = new ShippingBase(self::$shipping_methods, $this->method);
//        $city = $shippingBase->setCity($value)->cityFillDataForSave();
        $this->attributes['city'] = json_encode($value);
    }

    /**
     *
     * Перетаорення даних для збереження в ДБ
     *
     * @param $value
     */
    public function setAddressAttribute($value)
    {
//        $shippingBase = new ShippingBase(self::$shipping_methods, $this->method);
//        $address = $shippingBase->setCity($this->city['code'])->setAddress($value)->addressFillDataForSave();
        $this->attributes['address'] = json_encode($value);
    }
}
