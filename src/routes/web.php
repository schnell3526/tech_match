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

Route::redirect('/', '/index');

Route::get('/index', [IndexController::class, 'index'])->name('index');

Route::get('/search', [IndexController::class, 'search'])->name('search');

Route::get('/nav', [UsersController::class, 'index'])->name('user.index');



Route::post('/logout', [IndexController::class, 'logout']);



require __DIR__.'/auth.php';
