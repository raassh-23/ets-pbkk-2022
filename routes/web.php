<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('dashboard');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class)->only(['index', 'show']);

    Route::resource('writers', WriterController::class)->only(['index', 'show']);

    Route::resource('publishers', PublisherController::class)->only(['index', 'show']);

    Route::resource('users', UserController::class)->only(['index', 'show']);

    Route::resource('books.reviews', ReviewController::class)->except(['index', 'create', 'show', 'edit']);

    Route::middleware('isAdmin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::resource('books', BookController::class)->except(['index', 'show']);

        Route::resource('writers', WriterController::class)->except(['index', 'show']);
    
        Route::resource('publishers', PublisherController::class)->except(['index', 'show']);
    
        Route::resource('users', UserController::class)->except(['index', 'show']);
    });
});
