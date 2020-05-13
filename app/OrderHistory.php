<?php

namespace App;

use App\Events\OrderHistoryCreatedEvent;
use App\Events\OrderHistoryCreatingEvent;
use App\Listeners\OrderHistoryCreatedListener;
use App\Listeners\OrderHistoryCreatingListener;
use App\Traits\Helpers\SerializeDate;
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
    use SerializeDate;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'date_added' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
