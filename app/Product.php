<?php

namespace App;

use App\Services\ScopeFilters\ProductsFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Product
 *
 * @property int $id
 * @property int $category_id
 * @property int $brand_id
 * @property string $title
 * @property string $alias
 * @property string|null $content
 * @property float $price
 * @property float|null $old_price
 * @property string $status
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $img
 * @property string $hit
 * @property int $in_stock
 * @property int $visits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attribute[] $product_attributes
 * @property-read int|null $product_attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereHit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereVisits($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product filter(\App\Services\ScopeFilters\ProductsFilter $productsFilter, $filter)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Product onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withoutTrashed()
 */
class Product extends Model
{
    use SoftDeletes;
//    protected $dates = ['deleted_at'];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public $fillable = ['title',
        'alias',
        'category_id',
        'keywords',
        'description',
        'content',
        'price',
        'in_stock',
        'status',];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('rating', function (Builder $builder) {
            $builder->withCount(['comments as average_rating' => function($query) {
                $query->select(\DB::raw('coalesce(avg(rating),0)'));
            }]);
        });
        static::addGlobalScope('count_comments', function (Builder $builder) {
            $builder->withCount('comments');
        });
    }

    //
    public function product_attributes(){
        return $this->belongsToMany('App\Attribute');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function scopeFilter(Builder $query, ProductsFilter $productsFilter, $filter)
    {
        return $productsFilter->apply($query, $filter);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }

    public function getPriceAttribute($value)
    {
        return round(($value/100), 2);
    }
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = (int)((float)$value*100);
    }
    public function getOldPriceAttribute($value)
    {
        return round(($value/100), 2);
    }
    public function setOldPriceAttribute($value)
    {
        $this->attributes['old_price'] = (int)((float)$value*100);
    }
}
