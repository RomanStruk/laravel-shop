<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $req = Request::create(route('passport.token'), 'POST', [
            'grant_type' => config('shop.passport.grant_type'),
            'client_id' => config('shop.passport.client_id'),
            'client_secret' => config('shop.passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => ''
        ]);
//        dd($req);
        //->header('Authorization', 'Bearer ')
        $response = app()->handle($req);
//        return redirect('/admin/index', 302, ['Authorization', 'Bearer '.$response['access_token']]);
        return $response;
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }

    public function fastRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'phone' => 'required',
        ]);

        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => \Hash::make('12345'),
        ]);
        $user->detail()->create(['phone' => $request->phone]);
        $user['access_token'] = $user->createToken($request->email)->accessToken;
//        $user->load('detail');
        return response($user);
    }

}
