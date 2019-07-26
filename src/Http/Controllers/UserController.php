<?php

namespace ThormaWeb\AdminTheme\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use ThormaWeb\AdminTheme\AdminTheme;
use Illuminate\Support\Facades\Auth;
use ThormaWeb\AdminTheme\Http\Requests\UserRequest;
use Illuminate\Routing\Controller as BaseController;
use ThormaWeb\AdminTheme\Http\Requests\ProfileRequest;

class UserController extends BaseController
{
    public function index(UserRequest $request)
    {
        return view('admin-theme::user.index')->with('users', User::paginate());
    }

    public function create()
    {
        return view('admin-theme::user.create')
               ->with('roles', AdminTheme::generateSelectOptions(Role::all(), 'id', 'name'));
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
            ->with('user', User::findOrFail($id))
            ->with('roles', AdminTheme::generateSelectOptions(Role::all(), 'id', 'name'));
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