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
    Route::get('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    Route::prefix('/sensor')->group(function(){
        Route::post('/', [\App\Http\Controllers\SensorController::class, 'store']);
        Route::put('/{id}', [\App\Http\Controllers\SensorController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\SensorController::class, 'delete']);
    });
});

Route::middleware('sensorAuth')->post('/store', [\App\Http\Controllers\MeasurementController::class, 'store']);

Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::get('/weather/{id}', [\App\Http\Controllers\HomeController::class, 'home']);
Route::get('/weather', [\App\Http\Controllers\HomeController::class, 'home']);

Route::prefix('/history')->group(function(){
    Route::get('/day/{id}', [\App\Http\Controllers\MeasurementController::class, 'lastDay']);
    Route::get('/week/{id}', [\App\Http\Controllers\MeasurementController::class, 'lastWeek']);
    Route::get('/month/{id}', [\App\Http\Controllers\MeasurementController::class, 'lastMonth']);
    Route::get('/year/{id}', [\App\Http\Controllers\MeasurementController::class, 'lastYear']);
});

Route::prefix('/sensor')->group(function(){
    Route::middleware('optionalApiAuth')->get('/', [\App\Http\Controllers\SensorController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\SensorController::class, 'get']);
});
