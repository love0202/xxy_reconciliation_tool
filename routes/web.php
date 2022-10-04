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
    Route::get('/merchant/create', [App\Http\Controllers\Merchant\MerchantController::class, 'create'])->name('merchant.create');
    Route::get('/merchant/tianmao', [App\Http\Controllers\Merchant\MerchantController::class, 'tianmao'])->name('merchant.tianmao');
    Route::get('/merchant/taobao', [App\Http\Controllers\Merchant\MerchantController::class, 'taobao'])->name('merchant.taobao');
    Route::get('/merchant/pinduoduo', [App\Http\Controllers\Merchant\MerchantController::class, 'pinduoduo'])->name('merchant.pinduoduo');
    Route::get('/express/index', [App\Http\Controllers\Express\ExpressController::class, 'index'])->name('express.index');
    Route::get('/express/file', [App\Http\Controllers\Express\ExpressController::class, 'file'])->name('express.file');
    Route::get('/express/create', [App\Http\Controllers\Express\ExpressController::class, 'create'])->name('express.create');
    Route::get('/weight/index', [App\Http\Controllers\Weight\WeightController::class, 'index'])->name('weight.index');
    Route::get('/weight/file', [App\Http\Controllers\Weight\WeightController::class, 'file'])->name('weight.file');
    Route::get('/weight/create', [App\Http\Controllers\Weight\WeightController::class, 'create'])->name('weight.create');
    Route::post('/weight/store', [App\Http\Controllers\Weight\WeightController::class, 'store'])->name('weight.store');
});

// 测试页面
Route::get('/test/bootstrap', function () {
    return view('test.bootstrap');
});
Route::get('/test/components', function () {
    return view('test.components');
});
Route::get('/test/img', [App\Http\Controllers\TestController::class, 'img'])->name('test.img');
