<?php

namespace App;

use App\Services\ScopeFilters\ProductsFilter;
use App\Traits\Helpers\ProductHelper;
use App\Traits\Helpers\SerializeDate;
use App\Traits\Relations\ProductRelations;
use App\Traits\Status;
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product filter($filter)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read int|null $media_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Product onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $related
 * @property-read int|null $related_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product avgRating()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product countComments()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SoldProduct[] $sold
 * @property-read int|null $sold_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product allRelations()
 */
class Product extends Model
{
    use SoftDeletes;
    use ProductRelations;
    use SerializeDate;
    use ProductHelper;
    use Status;

    public $fillable = [
        'title',
        'alias',
        'category_id',
        'keywords',
        'description',
        'content',
        'price',
        'in_stock',
        'status',
        ];

    const STATUS_HIDE       = 0;
    const STATUS_ACTIVE     = 1;

    /**
     * Return list of status codes and labels
     * @return array
     */
    public static function listStatus()
    {
        return [
            self::STATUS_ACTIVE     => 'Активний',
            self::STATUS_HIDE       => 'Скритий',
        ];
    }

    public function scopeFilter(Builder $query, $filter)
    {
        return (new ProductsFilter())->apply($query, $filter);
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


    /**
     * Scope a query to get all relations
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllRelations($query)
    {
        return $query->with(['category', 'media:media.id,media.url'])
            ->with('comments')
            ->with('comments.user')
            ->with('comments.user.detail')
            ->with('product_attributes')
            ->with('product_attributes.filter');
    }

    public function attachMediaFiles($ids)
    {
        return $this->media()->attach($ids);
    }
}
