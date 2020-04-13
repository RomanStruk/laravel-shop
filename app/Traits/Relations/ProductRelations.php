<?php


namespace App\Traits\Relations;


use App\Media;
use App\Order;

trait ProductRelations
{
    //
    public function product_attributes(){
        return $this->belongsToMany('App\Attribute');
    }

    public function category()
    {
        return $this->belongsTo('App\Category')->withDefault(['name'=> 'Deleted']);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }
}
