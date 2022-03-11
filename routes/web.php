<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminShopController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminImageController;
use App\Http\Controllers\AdminMailController;
use App\Http\Controllers\PaymentController;


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


Route::post('/stripe/webhook', [PaymentController::class, 'webhook']);

Route::prefix('admin')->group(function(){
    Route::get('/', function () {
        if(Route::middleware('auth:admin')){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login');
        }
    });
    Route::get('login',[LoginController::class, 'create'])->name('admin.login');
    Route::post('login',[LoginController::class,'store']);
    Route::post('logout',[LoginController::class, 'destroy'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function(){
        Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
        Route::post('manager',[AdminController::class, 'store']);
        Route::get('shop', [AdminShopController::class, 'index']);
        Route::post('shop', [AdminShopController::class, 'create'])->name('admin.shop.create');
        Route::put('shop', [AdminShopController::class, 'update'])->name('admin.shop.update');
        Route::get('booking', [AdminBookingController::class, 'index']);
        Route::get('booking/{bookingId}', [AdminBookingController::class, 'show']);
        Route::get('image', [AdminImageController::class, 'index']);
        Route::post('image', [AdminImageController::class, 'store']);
        Route::get('mail/{userId}', [AdminMailController::class, 'index']);
        Route::post('mail', [AdminMailController::class, 'send']);
    });
});


