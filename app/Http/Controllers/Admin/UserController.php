<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\GetUserByIdOrEmail;
use App\Services\User\GetUsersByLimit;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param GetUsersByLimit $getUsersByLimit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, GetUsersByLimit $getUsersByLimit)
    {
        $users = $getUsersByLimit->handel($request->except('limit'), ['id', 'email'], $request->get('limit'));
        return view('admin.user.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param GetUserByIdOrEmail $getUserByIdOrEmail
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(GetUserByIdOrEmail $getUserByIdOrEmail, $userId)
    {
        $user = $getUserByIdOrEmail->handel($userId, ['*'], true);
        return view('admin.user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $userId
     * @return void
     */
    public function edit($userId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $userId
     * @return void
     */
    public function update(Request $request, $userId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $userId
     * @return void
     */
    public function destroy($userId)
    {
        //
    }
}
