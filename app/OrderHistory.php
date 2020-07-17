<?php

namespace App;

use App\Events\OrderHistoryCreatedEvent;
use App\Events\OrderHistoryCreatingEvent;
use App\Listeners\OrderHistoryCreatedListener;
use App\Listeners\OrderHistoryCreatingListener;
use App\Traits\Helpers\SerializeDate;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderDetail
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $date_added
 * @property string $comment
 * @property int $status
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereDateAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereUserId($value)
 * @mixin \Eloquent
 */
class OrderHistory extends Model
{
    use SerializeDate, Status;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'date_added' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

}
