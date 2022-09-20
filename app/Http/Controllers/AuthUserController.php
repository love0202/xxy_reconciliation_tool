<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    public function login()
    {
        return view('auth_user.login');
    }

    public function login_store(LoginRequest $request)
    {
        $request->validated();

        $params = [];
        $input = $request->all();
        $params['username'] = $input['username'];
        $params['password'] = $input['password'];

        if (Auth::guard()->attempt($params)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => '密码不正确',
        ]);
    }
    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->intended('/');
    }
}
