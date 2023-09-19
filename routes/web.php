<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store',[LoginController::class,'store'])->name('postLogin');

//admin,group auth
Route::middleware(['auth'])->group(function(){
    //group admin
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);
        //group menu
        Route::prefix('menus')->group(function(){
            Route::get('list',[MenuController::class,'getList'])->name('listMenu');

            Route::get('add',[MenuController::class,'create'])->name('addMenu');
            Route::post('add',[MenuController::class,'store'])->name('postAddMenu');
            Route::get('edit/{menu}',[MenuController::class,'edit']);
            Route::post('edit/{menu}',[MenuController::class,'postEdit']);

            Route::DELETE('destroy',[MenuController::class,'destroy']);

        });
    });

});

//middleware('auth') tự động về route name('login') ,yeeu câu bắt buộc phải là name('login') mặc định

