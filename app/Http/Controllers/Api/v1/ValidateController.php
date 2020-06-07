<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ValidateController extends Controller
{

    public function email($email)
    {
        return response(['exists' => User::select('id')->where('email', $email)->exists()]);
    }

}
