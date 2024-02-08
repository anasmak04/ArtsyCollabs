<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource("/user", UserController::class);
Route::resource('/project', ProjectController::class);
Route::resource("/partner", PartnerController::class);
Route::get('/user/statistics', [UserController::class, 'Statistic'])->name('user.statistics');
Route::get('/', function () {
    return view('welcome');
});
