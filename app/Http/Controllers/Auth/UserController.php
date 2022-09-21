<?php

namespace App\Http\Controllers\Auth;;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {
        return view('auth_user.login');
    }

    public function store(LoginRequest $request)
    {
        $request->validated();

        $input = $request->only(['username','password']);

        if (Auth::guard()->attempt($input)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'password' => '密码不正确',
        ]);
    }
    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('dashboard.index');
    }
}
