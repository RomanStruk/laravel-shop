<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Attribute
 *
 * @property int $id
 * @property string $value
 * @property int $group_attribute_id
 * @property-read \App\GroupAttribute $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereGroupAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereValue($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    public $timestamps = false;

    public function products(){
        return $this->belongsToMany('App\Product');
    }

    public function group()
    {
        return $this->belongsTo('App\GroupAttribute', 'group_attribute_id', 'id');
    }


}
