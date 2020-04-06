<?php


namespace App\Traits\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait RoleRelations
{
    /**
     * Role has many users.
     *
     * @return belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
