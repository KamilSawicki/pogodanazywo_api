<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('apiAuth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('apiAuth')->group(function(){
    Route::get('auth/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::prefix('/sensor')->group(function(){
        Route::get('/', [\App\Http\Controllers\SensorController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\SensorController::class, 'get']);
        Route::post('/', [\App\Http\Controllers\SensorController::class, 'store']);
        Route::put('/{id}', [\App\Http\Controllers\SensorController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\SensorController::class, 'delete']);
    });


});

Route::post('auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('auth/register', [\App\Http\Controllers\AuthController::class, 'register']);


Route::prefix('/test')->group(function(){
    Route::get('/', [\App\Http\Controllers\TestController::class, 'index']);
    Route::get('/{uuid}', [\App\Http\Controllers\TestController::class, 'find']);
    Route::delete('/{uuid}', [\App\Http\Controllers\TestController::class, 'delete']);
    Route::post('/', [\App\Http\Controllers\TestController::class, 'create']);
});
