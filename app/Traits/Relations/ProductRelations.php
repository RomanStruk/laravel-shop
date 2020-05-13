<?php


namespace App\Traits\Relations;


use App\Media;
use App\Order;
use App\Product;
use App\SoldProduct;
use App\Syllable;

trait ProductRelations
{
    public function syllable()
    {
        return $this->hasMany(Syllable::class);
    }

    //
    public function product_attributes()
    {
        return $this->belongsToMany('App\Attribute');
    }

    public function category()
    {
        return $this->belongsTo('App\Category')->withDefault(['name' => 'Deleted']);
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

    public function related()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_id', 'id', 'id');
    }

    public function sold()
    {
        return $this->hasMany(SoldProduct::class);
    }
}
