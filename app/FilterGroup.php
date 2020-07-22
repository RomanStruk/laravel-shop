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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Filter[] $allAttributes
 * @property-read int|null $all_attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Filter[] $filterValues
 * @property-read int|null $filter_values_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterGroup allRelations()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterGroup whereName($value)
 * @mixin \Eloquent
 */
class FilterGroup extends Model
{
    public $timestamps = false;

    public $fillable = ['name'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
//old
    public function allAttributes()
    {
        return $this->hasMany('\App\Filter');
    }
//old
    public function filterValues()
    {
        return $this->hasMany('\App\Filter');
    }

    // actual
    public function filters()
    {
        return $this->hasMany(Filter::class);
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
