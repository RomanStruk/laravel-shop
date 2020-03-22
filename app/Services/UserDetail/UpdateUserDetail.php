<?php


namespace App\Services\UserDetail;


use App\User;

class UpdateUserDetail
{
    public function handel(User $user, $fields)
    {
        $user->detail()->update($fields);
    }
}
