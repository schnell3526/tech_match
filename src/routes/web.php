<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

use App\Http\Controllers\UsersController;



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

Route::get('/index', [IndexController::class, 'index'])->name('index');

Route::get('/wordsearch', [IndexController::class, 'search'])->name('search');



Route::get('/logout', [Indexcontroller::class, 'logout']);

Route::get('/nav', [UsersController::class, 'index'])->name('users.index');

require __DIR__.'/auth.php';
