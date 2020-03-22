<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserMultipleRequest;
use App\Services\SaveFile;
use App\Services\User\CreateUser;
use App\Services\User\DeleteUserById;
use App\Services\User\GetUserByIdOrEmail;
use App\Services\User\GetUsersByLimit;
use App\Services\User\UpdateUserById;
use App\Services\UserDetail\CreateUserDetail;
use App\Services\UserDetail\UpdateUserDetail;
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
        $users = $getUsersByLimit->handel(
            $request->except('limit'),
            ['id', 'email'],
            $request->get('limit')
        );
        return view('admin.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserMultipleRequest $request
     * @param CreateUser $createUser
     * @param CreateUserDetail $createUserDetail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserMultipleRequest $request,
                          CreateUser $createUser,
                          CreateUserDetail $createUserDetail)
    {
        $user = $createUser->handel($request->all());


        $insertForUserDetail = $request->all();
        $insertForUserDetail['avatar'] = '/storage/avatars/avatar-2.jpg';
        if ($request->hasFile('avatar')){
            $insertForUserDetail['avatar'] = (new SaveFile())->handel($request->file('avatar'), 'avatars')['url'];
        }
        $user = $createUserDetail->handel($user, $insertForUserDetail);

        return redirect()->route('admin.user.show', ['user' => $user->id])->with('success', __('user.save'));
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
     * @param GetUserByIdOrEmail $getUserByIdOrEmail
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(GetUserByIdOrEmail $getUserByIdOrEmail, $userId)
    {
        $user = $getUserByIdOrEmail->handel($userId);
        return view('admin.user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserMultipleRequest $request
     * @param GetUserByIdOrEmail $getUserByIdOrEmail
     * @param UpdateUserById $updateUserById
     * @param UpdateUserDetail $updateUserDetail
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserMultipleRequest $request,
                           GetUserByIdOrEmail $getUserByIdOrEmail,
                           UpdateUserById $updateUserById,
                           UpdateUserDetail $updateUserDetail,
                           $userId)
    {
        $user = $getUserByIdOrEmail->handel($userId);

        $updateUserById->handel($user, $request->input('email'), $request->input('password'));

        $detailFields = $request->only(['first_name','last_name','phone','country','birthday','location']);
        if ($request->hasFile('avatar')){
            $detailFields['avatar'] = (new SaveFile())->handel($request->file('avatar'), 'avatars')['url'];
        }
        $updateUserDetail->handel($user, $detailFields);

        return redirect()->back()->with('success', __('user.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GetUserByIdOrEmail $getUserByIdOrEmail
     * @param DeleteUserById $deleteUserById
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(GetUserByIdOrEmail $getUserByIdOrEmail,
                            DeleteUserById $deleteUserById,
                            $userId)
    {
        $user = $getUserByIdOrEmail->handel($userId);
        $deleteUserById->handel($user);
        return redirect()->route('admin.user.index')->with('success', __('user.delete'));
    }
}
