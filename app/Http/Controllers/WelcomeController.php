<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome() {
        $most_reviewed_books = Book::all()->toQuery()->withCount('reviews')->orderBy('reviews_count', 'desc')->take(6)->get();
        $highest_rating_books = Book::all()->sortByDesc('rating')->take(6);
        $top_users = User::all()->sortByDesc('reviews')->take(4);

        return view('welcome', compact('most_reviewed_books', 'highest_rating_books', 'top_users'));
    }
}
