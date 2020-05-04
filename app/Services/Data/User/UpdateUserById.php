<?php


namespace App\Services\Data\User;



use App\User;
use Hash;

class UpdateUserById
{
    public function handel(User $user, $email, $password): User
    {
        $user->email = $email;
        if (! empty($password)) $user->password = Hash::make($password);
        if(! $user->save()){
            abort(403);
        }
        return $user;
    }
}
