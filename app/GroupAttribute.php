<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GroupAttribute
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attribute[] $allAttributes
 * @property-read int|null $all_attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GroupAttribute whereName($value)
 * @mixin \Eloquent
 */
class GroupAttribute extends Model
{
    public $timestamps = false;

    protected $table = 'group_attributes';

    public function allAttributes()
    {
        return $this->hasMany('\App\Attribute');
    }
    //
}
