<?php


namespace App\Repositories;


use App\User as Model;

class UserRepository extends Repository
{
    public function updateDetail(Model $user, $input)
    {
        return $user->detail()->update($input);
    }
}
