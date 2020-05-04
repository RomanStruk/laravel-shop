<?php

namespace App;

use App\Traits\Helpers\SerializeDate;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Payment
 *
 * @property int $id
 * @property int $order_id
 * @property int $paid
 * @property string $method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use SerializeDate;
    /**
     * @param array $fillable
     * @return Payment
     */
    public $fillable = ['paid', 'method'];

    const NO_PAID = 0;
    const PAID = 1;

    const METHOD_CARD = 'card';
    const METHOD_RECEIPT = 'receipt';
    const METHOD_GOOGLE_PAY = 'google-pay';


    public function isPaid()
    {
        return $this->paid == '1';
    }
}
