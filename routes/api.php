<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('shops', ShopController::class);
Route::apiResource('favorite', FavoriteController::class);
Route::apiResource('booking', BookingController::class);
Route::apiResource('review', ReviewController::class);
Route::apiResource('images', ImageController::class);

Route::post('/pay', [PaymentController::class, 'session']);
Route::post('/stripe/webhook', [PaymentController::class, 'webhook']);

// Route::get('/review/{shop_id}', [ReviewController::class, '']);