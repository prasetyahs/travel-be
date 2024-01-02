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

Route::resource("/", LoginController::class);
Route::post("/login", [LoginController::class, 'login']);
Route::get('/dashboard/logout', [UsersController::class, 'logout'])->middleware("check.auth");
Route::resource("/dashboard/home", HomeController::class)->middleware("check.auth");
Route::resource("/dashboard/categories", CategoriesController::class)->middleware("check.auth");
Route::resource("/dashboard/travel", TravelController::class)->middleware("check.auth");
Route::resource("/dashboard/users", UsersController::class)->middleware("check.auth");
Route::resource("/dashboard/profile", ProfileController::class)->middleware("check.auth");
