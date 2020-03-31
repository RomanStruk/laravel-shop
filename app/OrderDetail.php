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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail whereDateAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderDetail whereStatus($value)
 * @mixin \Eloquent
 */
class OrderDetail extends Model
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

}
