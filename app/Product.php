<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function product_attributes(){
        return $this->belongsToMany('App\Attribute');
    }

    public function pr_attr($arr)
    {
        return $this->belongsToMany('App\Attribute')
            ->whereIn('id', $arr);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
