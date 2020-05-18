<?php

namespace App;

use App\Services\ScopeFilters\OrdersFilter;
use App\Traits\Helpers\OrderHelper;
use App\Traits\Helpers\SerializeDate;
use App\Traits\Relations\OrderRelations;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderProduct[] $orderProducts
 * @property-read int|null $order_products_count
 * @property-read \App\Payment|null $payment
 * @property-read \App\Shipping|null $shipping
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order allRelations()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order countProductGroupByWeek()
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
    use OrderRelations, OrderHelper;
    use SerializeDate;
    use Status;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    const STATUS_PENDING = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELED = 4;
    const STATUS_REVERSED = 5;
//    const STATUS_DENIED = 6;
//    const STATUS_FAILED = 7;

    /**
     * Return list of status codes and labels
     * @return array
     */
    public static function listStatus()
    {
        return [
            self::STATUS_PENDING => 'Очікує на розгляд',
            self::STATUS_PROCESSING => 'Обробляється',
            self::STATUS_COMPLETED => 'Завершений',
            self::STATUS_CANCELED => 'Скасовано',
            self::STATUS_REVERSED => 'Повернутий',
//            self::STATUS_DENIED => 'Відхілити',
//            self::STATUS_FAILED => 'Не вдалося',
        ];
    }

    public function isEditable()
    {
        if ($this->status == self::STATUS_PROCESSING or $this->status == self::STATUS_PENDING)
            return true;
        return false;
    }

    public function availableListStatus()
    {
        $list = self::listStatus();
        if ($this->status == self::STATUS_COMPLETED)
            return [self::STATUS_REVERSED => $list[self::STATUS_REVERSED]];
        if ($this->status == self::STATUS_PENDING or $this->status == self::STATUS_PROCESSING)
            return [
                self::STATUS_PENDING => $list[self::STATUS_PENDING],
                self::STATUS_PROCESSING => $list[self::STATUS_PROCESSING],
                self::STATUS_COMPLETED => $list[self::STATUS_COMPLETED],
                self::STATUS_CANCELED => $list[self::STATUS_CANCELED],
            ];
        if ($this->status == self::STATUS_CANCELED)
            return [self::STATUS_PROCESSING => $list[self::STATUS_PROCESSING]];
        return $list;

    }

    /**
     * Тільки замовлення які можна редагувати
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyEditable(Builder $query)
    {
        return $query->where('status' , '=', self::STATUS_PENDING)
            ->orWhere('status' , '=', self::STATUS_PROCESSING);
    }

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
        return $query->select([\DB::raw("SUM(order_products.count) as count_sold"), \DB::raw("order_products.product_id as product_id"), \DB::raw('week(created_at)')])
            ->rightJoin('order_products', function ($query) {
                $query->on('order_products.order_id', '=', 'orders.id')->where('order_products.product_id', '=', '3');
            })
            ->where('status', '=', self::STATUS_COMPLETED)
            ->groupBy('week(created_at)', 'product_id');
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
            ->with('user')
            ->with('user.detail')
            ->with('histories')
            ->with('histories.user')
            ->with('payment')
            ->with('shipping');
    }
}
