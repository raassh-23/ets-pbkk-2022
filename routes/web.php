<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\ReviewController;
use App\Models\Publisher;
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
    Route::resource('book', BookController::class)->except('index');

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::resource('writer', WriterController::class);

    Route::resource('publisher', PublisherController::class);

    Route::resource('review', ReviewController::class)->except(['index', 'create', 'show', 'edit']);
});
