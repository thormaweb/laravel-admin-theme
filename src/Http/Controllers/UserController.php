<?php

namespace iVirtual\AdminTheme\Http\Controllers;

use App\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use iVirtual\AdminTheme\Http\Requests\ProfileRequest;
use iVirtual\AdminTheme\Http\Requests\UserRequest;

class UserController extends BaseController
{
    public function index(UserRequest $request)
    {
        return view('admin-theme::user.index')->with('users', User::paginate());
    }

    public function create()
    {
        return view('admin-theme::user.create');
    }

    public function store(UserRequest $request)
    {

        $user = User::create(array_merge($request->all(), ['password' => bcrypt(rand(15,20))]));

        $user->syncRoles($request->get('role_ids', []));

        return redirect()->route('ivi_admin_theme_user_index');
    }

    public function edit($id)
    {
        return view('admin-theme::user.edit')
            ->with('user', User::findOrFail($id));
    }

    public function update(UserRequest $request, $id)
    {

        $user = User::findOrFail($id);

        $user->update($request->all());

        $user->syncRoles($request->get('role_ids', []));

        return redirect()->route('ivi_admin_theme_user_index');
    }

    public function delete($id)
    {

        User::findOrFail($id)->delete();

        return redirect()->route('ivi_admin_theme_user_index');
    }
}