<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserDetail
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\User $user
 */
class UserDetail extends Model
{
    public $timestamps = false;
    public $fillable = ['first_name', 'last_name', 'phone', 'avatar', 'country', 'birthday', 'location'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
