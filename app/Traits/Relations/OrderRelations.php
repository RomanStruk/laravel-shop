<?php


namespace App\Traits\Relations;


use App\Payment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait OrderRelations
{

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    /**
     * @return BelongsToMany
     */
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

    /**
     * @return hasOne|Payment
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}
