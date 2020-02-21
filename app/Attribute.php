<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function products(){
        return $this->belongsToMany('App\Product');
    }

    public function group()
    {
        return $this->belongsTo('App\GroupAttribute');
    }

    public function products_id(){
        return $this->hasMany('App\Product_attribute');
    }

}
