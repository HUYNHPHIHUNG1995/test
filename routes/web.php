<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use \App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\Users\UserController;
use \App\Http\Controllers\Ajax\LocationController;
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
//bat buoc dat ten login de su dung auth tu dong quay ve trang login
Route::get('admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store',[LoginController::class,'store'])->name('postLogin');
//ajax
Route::get('ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajaxLocation');
//admin,group auth
Route::middleware(['auth'])->group(function(){
    //logout
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
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
        //group user
        Route::prefix('user')->group(function (){
            Route::get('list',[UserController::class,'index'])->name('getListUser');
            Route::get('add',[UserController::class,'create'])->name('createUser');
            Route::post('add',[UserController::class,'store'])->name('postAddUser');
        });
        //group products
        Route::prefix('products')->group(function(){

            Route::get('add',[ProductController::class,'create'])->name('getAddProduct');//load trang addproduct
            Route::post('add',[ProductController::class,'store']);

        });
        //upload
        Route::post('upload/services',[UploadController::class,'store']);
    });

});

//middleware('auth') tự động về route name('login') ,yeeu câu bắt buộc phải là name('login') mặc định

