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


    Route::get('/merchant/tianmao/file', [App\Http\Controllers\Merchant\TianmaoController::class, 'file'])->name('merchant.tianmao.file');
    Route::get('/merchant/tianmao/index', [App\Http\Controllers\Merchant\TianmaoController::class, 'index'])->name('merchant.tianmao.index');
    Route::get('/merchant/tianmao/create', [App\Http\Controllers\Merchant\TianmaoController::class, 'create'])->name('merchant.tianmao.create');
    Route::post('/merchant/tianmao/store', [App\Http\Controllers\Merchant\TianmaoController::class, 'store'])->name('merchant.tianmao.store');
    Route::post('/merchant/tianmao/ajax_destroy_file', [App\Http\Controllers\Merchant\TianmaoController::class, 'ajax_destroy_file'])->name('merchant.tianmao.ajax_destroy_file');

    Route::get('/merchant/pinduoduo/file', [App\Http\Controllers\Merchant\PinduoduoController::class, 'file'])->name('merchant.pinduoduo.file');
    Route::get('/merchant/pinduoduo/index', [App\Http\Controllers\Merchant\PinduoduoController::class, 'index'])->name('merchant.pinduoduo.index');
    Route::get('/merchant/pinduoduo/create', [App\Http\Controllers\Merchant\PinduoduoController::class, 'create'])->name('merchant.pinduoduo.create');
    Route::post('/merchant/pinduoduo/store', [App\Http\Controllers\Merchant\PinduoduoController::class, 'store'])->name('merchant.pinduoduo.store');
    Route::post('/merchant/pinduoduo/ajax_destroy_file', [App\Http\Controllers\Merchant\PinduoduoController::class, 'ajax_destroy_file'])->name('merchant.pinduoduo.ajax_destroy_file');

    Route::get('/merchant/wangdiantong/file', [App\Http\Controllers\Merchant\WangdiantongController::class, 'file'])->name('merchant.wangdiantong.file');
    Route::get('/merchant/wangdiantong/index', [App\Http\Controllers\Merchant\WangdiantongController::class, 'index'])->name('merchant.wangdiantong.index');
    Route::get('/merchant/wangdiantong/create', [App\Http\Controllers\Merchant\WangdiantongController::class, 'create'])->name('merchant.wangdiantong.create');
    Route::post('/merchant/wangdiantong/store', [App\Http\Controllers\Merchant\WangdiantongController::class, 'store'])->name('merchant.wangdiantong.store');
    Route::post('/merchant/wangdiantong/ajax_destroy_file', [App\Http\Controllers\Merchant\WangdiantongController::class, 'ajax_destroy_file'])->name('merchant.wangdiantong.ajax_destroy_file');


    Route::get('/express/index', [App\Http\Controllers\Express\ExpressController::class, 'index'])->name('express.index');
    Route::get('/express/create', [App\Http\Controllers\Express\ExpressController::class, 'create'])->name('express.create');
    Route::post('/express/store', [App\Http\Controllers\Express\ExpressController::class, 'store'])->name('express.store');
    Route::get('/express/file', [App\Http\Controllers\Express\ExpressController::class, 'file'])->name('express.file');
    Route::post('/express/ajax_destroy_file', [App\Http\Controllers\Express\ExpressController::class, 'ajax_destroy_file'])->name('express.ajax_destroy_file');
    Route::get('/express/export_file', [App\Http\Controllers\Express\ExpressController::class, 'export_file'])->name('express.export_file');


    Route::get('/weight/index', [App\Http\Controllers\Weight\WeightController::class, 'index'])->name('weight.index');
    Route::get('/weight/create', [App\Http\Controllers\Weight\WeightController::class, 'create'])->name('weight.create');
    Route::post('/weight/store', [App\Http\Controllers\Weight\WeightController::class, 'store'])->name('weight.store');
    Route::get('/weight/edit', [App\Http\Controllers\Weight\WeightController::class, 'edit'])->name('weight.edit');
    Route::post('/weight/ajax_destroy', [App\Http\Controllers\Weight\WeightController::class, 'ajax_destroy'])->name('weight.ajax_destroy');
    Route::post('/weight/ajax_destroy_file', [App\Http\Controllers\Weight\WeightController::class, 'ajax_destroy_file'])->name('weight.ajax_destroy_file');
    Route::get('/weight/file', [App\Http\Controllers\Weight\WeightController::class, 'file'])->name('weight.file');

    Route::post('/public/ajax_export_status', [App\Http\Controllers\Controller::class, 'ajax_export_status'])->name('public.ajax_export_status');
});

// 测试页面
Route::get('/test/bootstrap', function () {
    return view('test.bootstrap');
});
Route::get('/test/components', function () {
    return view('test.components');
});
Route::get('/test/img', [App\Http\Controllers\TestController::class, 'img'])->name('test.img');
