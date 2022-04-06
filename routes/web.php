<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BookController as AdminBookController;
use App\Http\Controllers\admin\PublisherController as AdminPublisherController;
use App\Http\Controllers\admin\ReviewController as AdminReviewController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\admin\WriterController as AdminWriterController;
use App\Http\Controllers\WelcomeController;
use App\Models\Book;
use App\Models\User;
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

Route::get('/', [WelcomeController::class, 'welcome']);

Auth::routes();

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::resource('writers', WriterController::class)->only(['index', 'show']);

Route::resource('publishers', PublisherController::class)->only(['index', 'show']);

Route::resource('users', UserController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('books.reviews', ReviewController::class)->only(['store', 'update', 'destroy']);

    Route::prefix('admin')->middleware('isAdmin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('books', AdminBookController::class)->except(['show']);

        Route::resource('writers', AdminWriterController::class)->except(['show']);

        Route::resource('publishers', AdminPublisherController::class)->except(['show']);

        Route::resource('users', AdminUserController::class)->only(['index', 'update', 'destroy']);

        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);
    });
});
