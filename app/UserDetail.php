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
 * @property string|null $avatar
 * @property string|null $country
 * @property string|null $birthday
 * @property string|null $location
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserDetail whereStatus($value)
 */
class UserDetail extends Model
{
    public $timestamps = false;
    public $fillable = ['first_name', 'last_name', 'phone', 'avatar', 'country', 'birthday', 'location'];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
