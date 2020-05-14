<?php

namespace App;

use App\Services\ScopeFilters\OrdersFilter;
use App\Services\Shipping\ShippingMethods\CourierMethod;
use App\Services\Shipping\ShippingMethods\NovaPoshtaMethod;
use App\Traits\Helpers\OrderHelper;
use App\Traits\Helpers\SerializeDate;
use App\Traits\Relations\OrderRelations;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $comment
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $sum_price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderHistory[] $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Payment|null $payment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Shipping|null $shipping
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order allRelations()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order filter($filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use SoftDeletes, Notifiable;
    use OrderRelations;
    use SerializeDate;
    use OrderHelper;
    use Status;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    const STATUS_PENDING    = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETED  = 3;
    const STATUS_CANCELED   = 4;
    const STATUS_DENIED     = 5;
    const STATUS_FAILED     = 6;
    const STATUS_REVERSED   = 7;

    /**
     * Accept Filters
     * @param Builder $query
     * @param $filter
     * @return Builder
     */
    public function scopeFilter(Builder $query, $filter)
    {
        return (new OrdersFilter())->apply($query, $filter);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCountProductGroupByWeek(Builder $query)
    {
        return $query->select('week(created_at)')->from();
    }

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

    /**
     * Scope a query to get all relations
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllRelations($query)
    {
        return $query
            ->with('orderProducts')
            ->with('orderProducts.product')
            ->with('orderProducts.product.category')
            ->with('orderProducts.syllable')
            ->with('user')
            ->with('user.detail')
            ->with('histories')
            ->with('histories.user')
            ->with('payment')
            ->with('shipping');
    }
}
