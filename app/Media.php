<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Media
 *
 * @property int $id
 * @property string $path
 * @property string $extension
 * @property int $size
 * @property string $url
 * @property string $visibility
 * @property string $disc
 * @property string $name
 * @property string|null $keywords
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereDisc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereVisibility($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 */
class Media extends Model
{
    public $guarded = [];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getSizeAttribute($size)
    {
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];

    }

}
