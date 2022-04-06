<?php

use App\Http\Controllers\admin\BookController as AdminBookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PublisherController as AdminPublisherController;
use App\Http\Controllers\admin\ReviewController as AdminReviewController;
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

Route::get('/', function () {
    $books = Book::all();
    $users = User::all();
    return view('welcome', compact('books', 'users'));
});

Auth::routes();

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::resource('writers', WriterController::class)->only(['index', 'show']);

Route::resource('publishers', PublisherController::class)->only(['index', 'show']);

Route::resource('users', UserController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('books.reviews', ReviewController::class)->except(['index', 'create', 'show', 'edit']);

    Route::prefix('admin')->middleware('isAdmin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('books', AdminBookController::class)->except(['show']);

        Route::get('/writers', [WriterController::class, 'indexAdmin'])->name('writers.index');

        Route::resource('writers', WriterController::class)->except(['index', 'show']);
    
        Route::resource('publishers', AdminPublisherController::class)->except(['show']);

        Route::get('/users', [UserController::class, 'indexAdmin'])->name('users.index');
    
        Route::resource('users', UserController::class)->only(['update', 'destroy']);

        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);
    });
});
