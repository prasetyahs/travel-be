<?php

use App\Http\Controllers\web\CategoriesController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\TravelController;
use App\Http\Controllers\web\UsersController;
use Illuminate\Support\Facades\Route;

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
Route::resource("/",LoginController::class);
Route::resource("/dashboard/home", HomeController::class);
Route::resource("/dashboard/categories", CategoriesController::class);
Route::resource("/dashboard/travel",TravelController::class);
Route::resource("/dashboard/users",UsersController::class);
Route::resource("/dashboard/profile",ProfileController::class);
