<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('auth.admin.login');
    }

    public function store(AdminRequest $request)
    {
        $request->validated();

        $input = $request->only(['username','password']);

        if (Auth::guard()->attempt($input)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }else{
            return back()->withErrors(['password' => '密码不正确']);
        }
    }
    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('dashboard.index');
    }
}
