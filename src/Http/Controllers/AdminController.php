<?php

namespace iVirtual\AdminTheme\Http\Controllers;

use App\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use iVirtual\AdminTheme\Http\Requests\ProfileRequest;

class AdminController extends BaseController
{

    public function login()
    {
        return view('admin-theme::auth.login');
    }

    public function passwordEmail()
    {
        return view('admin-theme::auth.password_email');
    }

    public function passwordReset()
    {
        return view('admin-theme::auth.password_reset');
    }

    public function dashboard()
    {
        return view('admin-theme::dashboard');
    }

    public function profile()
    {
        return view('admin-theme::profile');
    }

    public function updateProfile(ProfileRequest $request, $id = null)
    {
        $data = $request->all();

        if ($request->has('new_password')) {

            $data = array_add($data, 'password', bcrypt($request->get('new_password')));
        }

        if (is_null($id)) {

            $id = Auth::user()->id;
        }

        $user = User::findOrFail($id);

        $user->update($data);

        if ($request->file('avatar')) {

            $user->addMedia($request->files->get('avatar'))->toMediaCollection('avatar');
        }

        return redirect()->route('profile');
    }
}