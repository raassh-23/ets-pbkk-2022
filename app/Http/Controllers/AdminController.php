<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Review;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $booksCount = Book::count();
        $publishersCount = Publisher::count();
        $writersCount = Writer::count();
        $reviewsCount = Review::count();

        return view('admin.dashboard', compact('usersCount', 'categoriesCount', 'booksCount', 'writersCount', 'publishersCount', 'reviewsCount'));
    }
}
