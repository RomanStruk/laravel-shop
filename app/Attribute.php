<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function products(){
        return $this->belongsToMany('App\Product', 'product_attribute', 'attribute_id', 'product_id')
            ->withPivot('product_id');
    }

    public function products_id(){
        return $this->hasMany('App\Product_attribute');
    }

}
