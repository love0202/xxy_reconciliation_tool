<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\AuthUserController::class, 'login'])->name('auth_user.login');
Route::post('/login/login_store', [App\Http\Controllers\AuthUserController::class, 'login_store'])->name('auth_user.login_store');
Route::post('/logout', [App\Http\Controllers\AuthUserController::class, 'logout'])->name('auth_user.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});

// 测试页面
Route::get('/test/bootstrap', function () {
    return view('test.bootstrap');
});
