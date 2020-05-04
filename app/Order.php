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
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $type_delivery
 * @property string $pay_method
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read User $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCityCode($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereEmail($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereName($value)
 * @method static Builder|Order wherePayMethod($value)
 * @method static Builder|Order wherePhone($value)
 * @method static Builder|Order whereTypeDelivery($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @mixin \Eloquent
 * @property string $comment
 * @property-read Collection|OrderHistory[] $details
 * @property-read int|null $details_count
 * @property-read Payment $payment
 * @property-read Shipping $shipping
 * @method static Builder|Order whereComment($value)
 * @property Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|Order onlyTrashed()
 * @method static bool|null restore()
 * @method static Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Order withoutTrashed()
 * @method static Builder|Order filter($filter)
 * @method static Builder select($columns = [])
 * @property-read mixed $detail_status
 * @property-read mixed $sum_price
 * @property-read float|mixed $total_price
 * @property int $status
 * @property-read Collection|OrderHistory[] $histories
 * @property-read int|null $histories_count
 * @method static Builder|Order whereStatus($value)
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order allRelations()
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
        return $query->with('products')
            ->with('products.category')
            ->with('user')
            ->with('user.detail')
            ->with('histories')
            ->with('histories.user')
            ->with('payment')
            ->with('shipping');
    }
}
