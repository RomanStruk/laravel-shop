<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RelatedProducts
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $product_id
 * @property int $related_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RelatedProducts whereRelatedId($value)
 */
class RelatedProducts extends Model
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
