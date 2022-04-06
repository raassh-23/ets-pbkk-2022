<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search ?: '';
        $category = $request->category;

        $books = Book::whereRaw('LOWER(title) like ?', ['%'.strtolower($search).'%']);

        if ($category) {
            $books = $books->where('category_id', $category);
        }

        $books = $books->get();

        $categories = Category::orderBy('name', 'asc')->get();

        return view('book.index', compact('books', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.detail', compact('book'));
    }
}
