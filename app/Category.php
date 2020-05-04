<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CategoryService
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereSlug($value)
 * @mixin \Eloquent
 * @property string|null $description
 * @property-read \App\Category $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDescription($value)
 */
class Category extends Model
{
    public $fillable = ['name', 'slug', 'parent_id', 'description'];
    public $timestamps = false;
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function countProducts()
    {
        return $this->hasMany('App\Product')->count();
    }
    //
    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(){
        return $this->hasOne(self::class, 'id','parent_id');
    }
}
