<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('health-check', fn() => response("It's working!"));

Route::post('register', [RegisterController::class, 'index']);

Route::prefix('auth')
    ->controller(AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('refresh', 'refresh')->name('refresh');
        Route::get('me', 'me')->name('me');
        Route::post('logout', 'logout')->name('logout');
    });

Route::middleware('auth:api')->group(function () {
    Route::apiResource('product', ProductController::class);

    Route::apiResource('client', ClientController::class);

    Route::apiResource('order', OrderController::class)->except('destroy');
    Route::patch('order/{order}/change-status', [OrderController::class, 'changeStatus'])->name('order.changeStatus');
});
