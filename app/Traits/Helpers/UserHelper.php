<?php


namespace App\Traits\Helpers;

use Str;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 *
 */

trait UserHelper
{

    /**
     * Check if the user has role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->roles->contains(function ($value) use ($role) {
            return Str::is($role, $value->name);
        });
    }
}
