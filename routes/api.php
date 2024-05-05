<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
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
