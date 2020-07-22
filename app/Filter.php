<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Attribute
 *
 * @property int $id
 * @property string $value
 * @property int $filter_id
 * @property-read \App\FilterGroup $filter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter whereFilterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter whereValue($value)
 * @mixin \Eloquent
 */
class Filter extends Model
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

    public function filter_group()
    {
        return $this->belongsTo(FilterGroup::class);
    }


}
