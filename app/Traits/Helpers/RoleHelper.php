<?php


namespace App\Traits\Helpers;


trait RoleHelper
{
    public function attachUser($userId)
    {
        $this->users()->attach($userId);
    }
}
