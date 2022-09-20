<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [App\Http\Controllers\AuthUserController::class, 'login'])->name('auth_user.login');
Route::post('/login/login_store', [App\Http\Controllers\AuthUserController::class, 'login_store'])->name('auth_user.login_store');
Route::post('/logout', [App\Http\Controllers\AuthUserController::class, 'logout'])->name('auth_user.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});
