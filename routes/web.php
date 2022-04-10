<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Admin controllers
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;

//user controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopPageController;
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
Auth::routes();

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index']);
Route::get('/products', [ShopPageController::class, 'index'])->name('shop');


Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/','admin.auth.login')->name('login');
        Route::view('/login','admin.auth.login')->name('login');
        Route::view('/register','admin.auth.register')->name('register');
        Route::post('/register',[LoginController::class,'create'])->name('signup');
        Route::post('/check',[LoginController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/home','admin.dashboard.dashboard')->name('home');
        Route::post('/logout',[LoginController::class,'logout'])->name('logout');

        //banner controller
        Route::resource('banner', BannerController::class);
        Route::get('changeBannerStatus', [BannerController::class,'changeBannerStatus']);
        Route::get('/markAsRead', [BannerController::class, 'markAsRead'])->name('banner.mark');

        //category controller
        Route::resource('categories', CategoryController::class);

        //sub category controller
        Route::resource('sub_categories', SubCategoryController::class);

    });

});
