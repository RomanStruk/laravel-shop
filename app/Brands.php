<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Brands
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brands newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brands newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brands query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brands whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brands whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brands whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Brands extends Model
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
