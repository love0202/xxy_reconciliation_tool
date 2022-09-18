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

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login.index');
Route::post('/login/store', [App\Http\Controllers\LoginController::class, 'store'])->name('login.store');
