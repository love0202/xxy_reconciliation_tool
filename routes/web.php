<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\Auth\AdminController::class, 'login'])->name('auth.admin.login');
Route::post('/login/store', [App\Http\Controllers\Auth\AdminController::class, 'store'])->name('auth.admin.store');
Route::post('/logout', [App\Http\Controllers\Auth\AdminController::class, 'logout'])->name('auth.admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/project/index', [App\Http\Controllers\Project\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/show', [App\Http\Controllers\Project\ProjectController::class, 'show'])->name('project.show');
    Route::get('/project/create', [App\Http\Controllers\Project\ProjectController::class, 'create'])->name('project.create');
    Route::post('/project/store', [App\Http\Controllers\Project\ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/enter', [App\Http\Controllers\Project\ProjectController::class, 'enter'])->name('project.enter');
    Route::get('/project/quit', [App\Http\Controllers\Project\ProjectController::class, 'quit'])->name('project.quit');

    Route::get('/merchant/index', [App\Http\Controllers\Merchant\MerchantController::class, 'index'])->name('merchant.index');
    Route::get('/express/index', [App\Http\Controllers\Express\ExpressController::class, 'index'])->name('express.index');
    Route::get('/weight/index', [App\Http\Controllers\Weight\WeightController::class, 'index'])->name('weight.index');
});

// 测试页面
Route::get('/test/bootstrap', function () {
    return view('test.bootstrap');
});
Route::get('/test/components', function () {
    return view('test.components');
});
Route::get('/test/img', [App\Http\Controllers\TestController::class, 'img'])->name('test.img');
