<?php


namespace App\Traits\Relations;


use App\Filter;
use App\Media;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\Syllable;

trait ProductRelations
{
    public function syllable()
    {
        return $this->hasMany(Syllable::class)->havingCountProcessed()->havingCountAvailableRemains();
    }

    public function syllableWithOutScope()
    {
        return $this->hasMany(Syllable::class);
    }
//old
    public function product_attributes()
    {
        return $this->belongsToMany('App\Filter');
    }

// actual
    public function product_filters()
    {
        return $this->belongsToMany(Filter::class);
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
        return $this->belongsToMany(Order::class, OrderProduct::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_id', 'id', 'id');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }



}
