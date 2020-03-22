<?php


namespace App\Services\User;


use App\User;

class GetUserByIdOrEmail
{
    public function handel($idOrLogin, $fields = ['*'], $trashed = false): User
    {
        $query = is_numeric($idOrLogin) ? ['id' => $idOrLogin] : ['email' => $idOrLogin];

        $user = User::select($fields);

        if ($trashed) $user->withTrashed();

         $user = $user->with('detail')->where($query)->get()->first();
         if (! $user){
             abort(404);
         }
        return $user;
    }

}
