<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function countProducts()
    {
        return $this->hasMany('App\Product', 'category_id', 'id')->count();
    }
    //
    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }
}
