<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function product_attributes(){
        return $this->belongsToMany('App\Attribute', 'product_attribute', 'product_id', 'attribute_id');
    }

    public function pr_attr($arr)
    {
        return $this->belongsToMany('App\Attribute', 'product_attribute', 'product_id', 'attribute_id')
            ->whereIn('id', $arr);
    }

    public function category()
    {
        return $this->hasOne('App\Category');
    }

}
