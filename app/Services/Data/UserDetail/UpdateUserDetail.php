<?php


namespace App\Services\Data\UserDetail;


use App\User;

class UpdateUserDetail
{
    public function handel(User $user, $fields)
    {
        $user->detail()->update($fields);
    }
}
