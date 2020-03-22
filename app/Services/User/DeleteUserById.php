<?php


namespace App\Services\User;


use App\User;

class DeleteUserById
{
    public function handel(User $user, $forceDelete = false)
    {
        try {
            if ($forceDelete){
                $user = User::withTrashed()->findOrFail($user->id);
                return $user->forceDelete();
            }
            return $user->delete();
        } catch (\Exception $e) {
            throw abort(304);
        }
    }
}
