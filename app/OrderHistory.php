<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderDetail
 *
 * @property int $id
 * @property int $order_id
 * @property \Illuminate\Support\Carbon $date_added
 * @property string $comment
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereDateAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderHistory whereStatus($value)
 * @mixin \Eloquent
 */
class OrderHistory extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'date_added' => 'datetime',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
