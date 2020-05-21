<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Filter
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attribute[] $allAttributes
 * @property-read int|null $all_attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attribute[] $filterValues
 * @property-read int|null $filter_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter allRelations()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter whereName($value)
 * @mixin \Eloquent
 */
class Filter extends Model
{
    public $timestamps = false;

    public $fillable = ['name'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function allAttributes()
    {
        return $this->hasMany('\App\Attribute');
    }
    public function filterValues()
    {
        return $this->hasMany('\App\Attribute');
    }

    /**
     * Scope a query to get all relations
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllRelations($query)
    {
        return $query->with(['filterValues', 'allAttributes']);
    }
}
