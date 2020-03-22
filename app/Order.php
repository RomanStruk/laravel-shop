<?php

namespace App;


use App\Traits\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property int $city_code
 * @property string $email
 * @property string $type_delivery
 * @property string $pay_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePayMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTypeDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @mixin \Eloquent
 * @property string $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderDetail[] $details
 * @property-read int|null $details_count
 * @property-read \App\Payment $payment
 * @property-read \App\Shipping $shipping
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereComment($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Order onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Order withoutTrashed()
 */
class Order extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function shipping()
    {
        return $this->hasOne('App\Shipping');
    }

    public function details()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function payment()
    {
        return $this->hasOne(\App\Payment::class);
    }

    /**
     * Get sum of price of products
     * @return mixed
     */
    public function getSumPriceAttribute()
    {
        return $this->products->sum('price');;
    }

    use Status;

    const STATUS_PENDING    = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETED  = 3;
    const STATUS_CANCELED   = 4;
    const STATUS_DENIED     = 5;
    const STATUS_FAILED     = 6;
    const STATUS_REVERSED   = 7;

    /**
     * Return list of status codes and labels
     * @return array
     */
    public static function listStatus()
    {
        return [
            self::STATUS_PENDING    => 'Очікує на розгляд',
            self::STATUS_PROCESSING => 'Обробляється',
            self::STATUS_COMPLETED  => 'Завершений',
            self::STATUS_CANCELED   => 'Скасовано',
            self::STATUS_DENIED     => 'Відхілити',
            self::STATUS_FAILED     => 'Не вдалося',
            self::STATUS_REVERSED   => 'Повернутий',
        ];
    }

}
