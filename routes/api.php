<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\UsersController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'registration']);
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
});
Route::group(['prefix' => 'travel'], function () {
    Route::get('/', [TravelController::class, 'index']);
    Route::get('/cluster', [TravelController::class, 'clusteringData']);
    Route::get('/search', [TravelController::class, 'searchTravel']);
    Route::get("/range-price", [TravelController::class, 'getMaxMinRangePrice']);
    Route::get("/get-location", [TravelController::class, 'getLocation']);
});
Route::group(['prefix' => 'users'], function () {
    Route::put('/', [UsersController::class, 'editProfile']);
});
