<?php


namespace App\Services\Data\User;


use App\User;
use Hash;

class CreateUser
{
    public function handel(array $array)
    {
        $user = new User();
        $user->name = $array['name'];
        $user->email = $array['email'];
        $user->password = Hash::make($array['password']);
        if (! $user->save()){
            abort('403', 'Error Updating User');
        }
        return $user;
    }
}
