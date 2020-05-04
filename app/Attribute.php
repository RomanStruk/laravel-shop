<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Attribute
 *
 * @property int $id
 * @property string $value
 * @property int $group_attribute_id
 * @property-read \App\Filter $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereGroupAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereValue($value)
 * @mixin \Eloquent
 * @property int $filter_id
 * @property-read \App\Filter $filter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attribute whereFilterId($value)
 */
class Attribute extends Model
{
    public $timestamps = false;
    public $fillable = ['value'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function products(){
        return $this->belongsToMany('App\Product');
    }

    public function filter()
    {
        return $this->belongsTo('App\Filter');
    }


}
