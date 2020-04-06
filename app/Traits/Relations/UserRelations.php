<?php


namespace App\Traits\Relations;


use App\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserRelations
{
    /**
     * User has one UserDetail.
     *
     * @return hasOne
     */
    public function detail()
    {
        return $this->hasOne('App\UserDetail')->withDefault();
    }

    /**
     * User has many comments.
     *
     * @return hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * User has many Orders.
     *
     * @return hasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * User belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
