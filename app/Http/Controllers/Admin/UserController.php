<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserMultipleRequest;
use App\Services\PaginateSession;
use App\Services\SaveFile;
use App\User;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param PaginateSession $paginateSession
     * @return Factory|View
     */
    public function index(Request $request, PaginateSession $paginateSession)
    {
        $filters = $request->except('limit');
        $filters['dateDesc'] = 'true';
        $users = User::filter($filters)->allRelations()->paginate($paginateSession->getLimit(), ['id', 'email']);

        return view('admin.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserMultipleRequest $request
     * @return RedirectResponse
     */
    public function store(UserMultipleRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email =$request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $insertForUserDetail = $request->userDetailFillData();
        $insertForUserDetail['avatar'] = '/storage/avatars/avatar-2.jpg';
        if ($request->hasFile('avatar')){
            $insertForUserDetail['avatar'] = (new SaveFile())->handel($request->file('avatar'), 'avatars')['url'];
        }
        $user->createDetails($insertForUserDetail);

        return redirect()->route('admin.user.show', ['user' => $user->id])->with('success', __('user.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param $userId
     * @return Factory|View
     */
    public function show($userId)
    {
        $user = User::allRelations()->withTrashed()->findOrFail($userId);
        return view('admin.user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $userId
     * @return Factory|View
     */
    public function edit($userId)
    {
        $user = User::allRelations()->withTrashed()->findOrFail($userId);
        return view('admin.user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserMultipleRequest $request
     * @param $userId
     * @return RedirectResponse
     */
    public function update(UserMultipleRequest $request, $userId)
    {
        $user = User::allRelations()->withTrashed()->findOrFail($userId);

        $user->email = $request->input('email');
        if (! empty($request->input('password'))) $user->password = Hash::make($request->input('password'));
        $user->save();


        $detailFields = $request->userDetailFillData();
        if ($request->hasFile('avatar')){
            $detailFields['avatar'] = (new SaveFile())->handel($request->file('avatar'), 'avatars')['url'];
        }
        $user->updateDetails($detailFields);

        return redirect()->back()->with('success', __('user.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $userId
     * @return RedirectResponse
     */
    public function destroy($userId)
    {
        if (User::destroy($userId))
            return redirect()->route('admin.user.index')->with('success', __('user.deleted'));
        else
            return redirect()->route('admin.user.index')->withErrors( __('user.error_delete'));
    }
}
