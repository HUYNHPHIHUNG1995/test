<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use \App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\Users\UserController;
use \App\Http\Controllers\Admin\Users\UserCatalogueController;
use App\Http\Controllers\Ajax\DashboardController;
use \App\Http\Controllers\Ajax\LocationController;
use \App\Http\Controllers\Admin\LanguageController;
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
Route::post('ajax/dashboard/changeStatus',[DashboardController::class,'changeStatus'])->name('changeStatus');
Route::post('ajax/dashboard/changeAllStatus',[DashboardController::class,'changeAllStatus'])->name('changeAllStatus');
//admin,group auth
Route::middleware(['auth'])->group(function(){
    //logout
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
    //group admin
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);

        //group user
        Route::prefix('user')->group(function (){
            Route::get('list',[UserController::class,'index'])->name('getListUser');
            Route::get('create',[UserController::class,'create'])->name('createUser');
            Route::post('store',[UserController::class,'store'])->name('postAddUser');
            Route::get('edit/{id}',[UserController::class,'edit'])->where(['id'=>'[0-9]+'])->name('editUser');
            Route::post('update/{id}',[UserController::class,'update'])->where(['id'=>'[0-9]+'])->name('postEditUser');
            Route::post('destroy',[UserController::class,'destroy'])->name('postDeleteUser');

            Route::prefix('catalogue')->group(function (){
                Route::get('list',[UserCatalogueController::class,'index'])->name('getListCatalogueUser');
                Route::get('create',[UserCatalogueController::class,'create'])->name('createCatalogueUser');
                Route::post('store',[UserCatalogueController::class,'store'])->name('postAddCatalogueUser');
                Route::get('edit/{id}',[UserCatalogueController::class,'edit'])->where(['id'=>'[0-9]+'])->name('editCatalogueUser');
                Route::post('update/{id}',[UserCatalogueController::class,'update'])->where(['id'=>'[0-9]+'])->name('postEditCatalogueUser');
                Route::post('destroy',[UserCatalogueController::class,'destroy'])->name('postDeleteCatalogue');
            });
        });
        //post route
        Route::prefix('post')->group(function (){
            Route::get('list',[UserController::class,'index'])->name('getListPost');
            Route::get('create',[UserController::class,'create'])->name('createPost');
            Route::post('store',[UserController::class,'store'])->name('postAddUser');
            Route::get('edit/{id}',[UserController::class,'edit'])->where(['id'=>'[0-9]+'])->name('editPost');
            Route::post('update/{id}',[UserController::class,'update'])->where(['id'=>'[0-9]+'])->name('postEditPost');
            Route::post('destroy',[UserController::class,'destroy'])->name('postDeletePost');
        });

        //language route
        Route::prefix('language')->group(function (){
            Route::get('list',[LanguageController::class,'index'])->name('getListLanguage');
            Route::get('create',[LanguageController::class,'create'])->name('createLanguage');
            Route::post('store',[LanguageController::class,'store'])->name('postAddLanguage');
            Route::get('edit/{id}',[LanguageController::class,'edit'])->where(['id'=>'[0-9]+'])->name('editLanguage');
            Route::post('update/{id}',[LanguageController::class,'update'])->where(['id'=>'[0-9]+'])->name('postEditLanguage');
            Route::post('destroy',[LanguageController::class,'destroy'])->name('postDeleteLanguage');
        });
        //group menu
        Route::prefix('menus')->group(function(){
            Route::get('list',[MenuController::class,'getList'])->name('listMenu');

            Route::get('add',[MenuController::class,'create'])->name('addMenu');
            Route::post('add',[MenuController::class,'store'])->name('postAddMenu');
            Route::get('edit/{menu}',[MenuController::class,'edit']);
            Route::post('edit/{menu}',[MenuController::class,'postEdit']);

            Route::DELETE('destroy',[MenuController::class,'destroy']);

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

