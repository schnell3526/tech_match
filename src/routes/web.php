<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

use App\Http\Controllers\UsersController;

//プル陸


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

Route::get('/wordsearch', [IndexController::class, 'wordsearch'])->name('wordsearch');

Route::get('/jobsearch', [IndexController::class, 'jobsearch'])->name('jobsearch');

Route::get('/tagsearch', [IndexController::class, 'tagsearch'])->name('tagsearch');

Route::get('/logout', [Indexcontroller::class, 'logout']);

Route::get('/nav', [UsersController::class, 'index'])->name('users.index');

require __DIR__.'/auth.php';
