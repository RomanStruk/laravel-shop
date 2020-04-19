<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
//        $login = $request->only(['email', 'password']);

        if (! Auth::attempt($login)){
            return response(['message' => 'Error']);
        }
        // Creating a token without scopes...
            $token = Auth::user()->createToken('AuthToken')->accessToken;

        return response(['user' => \Auth::user(), 'accessToken' => $token]);
    }
}