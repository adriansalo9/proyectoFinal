<?php

use App\Http\Controllers\MineController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SnakeController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('snake',SnakeController::class)->middleware('auth');
Route::resource('score',ScoreController::class)->middleware('auth');
Route::resource('mine',MineController::class)->middleware('auth');
Route::resource('user',UserController::class)->middleware('auth');
