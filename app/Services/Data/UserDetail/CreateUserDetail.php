<?php


namespace App\Services\Data\UserDetail;


use App\User;
use App\UserDetail;

class CreateUserDetail
{
    public function handel(User $user, array $array)
    {
        $insert = [
            'first_name' => $array['first_name'],
            'last_name' => $array['last_name'],
            'phone' => $array['phone'],
            'country' => $array['country'],
            'birthday' => $array['birthday'],
            'location' => $array['location'],
            'avatar' => $array['avatar']
        ];
        if (! $user->detail()->save(new UserDetail($insert))){
            abort(403, 'Error Create User Detail');
        }
        return $user;
    }
}
