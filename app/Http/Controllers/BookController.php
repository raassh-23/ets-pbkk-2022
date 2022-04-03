<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $categories = Category::all();

        return view('book.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $writers = Writer::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('admin.book.create', compact('writers', 'publishers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'synopsis' => 'required',
            'edition' => 'required|numeric',
            'publish_year' => 'required|numeric|min:1900|max:2022',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'isbn' => 'required|numeric',
            'writer_id' => 'required|array|min:1',
            'writer_id.*' => 'required|exists:writers,id',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $path = Storage::disk('s3')->put('books', $request->cover_image);
        $url = Storage::disk('s3')->url($path);

        $book = Book::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'edition' => $request->edition,
            'publish_year' => $request->publish_year,
            'cover_image' => $url,
            'isbn' => $request->isbn,
            'publisher_id' => $request->publisher_id,
            'category_id' => $request->category_id,
        ]);

        if ($book) {
            $book->writers()->attach($request->writer_id);

            return redirect()->route('admin.books.index')->with([
                'success' => 'Book added successfully.',
            ]);
        }

        return redirect()->back()->with([
            'error' => 'Book creation failed',
        ]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $writers = Writer::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('admin.book.edit', compact('book', 'writers', 'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'synopsis' => 'required',
            'edition' => 'required|numeric',
            'publish_year' => 'required|numeric|min:1900|max:2022',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'isbn' => 'required|numeric',
            'writer_id' => 'required|array|min:1',
            'writer_id.*' => 'required|exists:writers,id',
            'publisher_id' => 'required|exists:publishers,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $newData = [
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'edition' => $request->edition,
            'publish_year' => $request->publish_year,
            'isbn' => $request->isbn,
            'publisher_id' => $request->publisher_id,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('cover_image')) {
            $path = Storage::disk('s3')->put('books', $request->cover_image);
            $url = Storage::disk('s3')->url($path);

            $newData['cover_image'] = $url;
        }

        if ($book->update($newData)) {
            $book->writers()->sync($request->writer_id);

            return redirect()->route('admin.books.index')->with([
                'success' => 'Book updated successfully.',
            ]);
        }

        return redirect()->back()->with([
            'error' => 'Book update failed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with([
            'success' => 'Book deleted successfully.',
        ]);
    }

    public function indexAdmin() 
    {
        $books = Book::all();

        return view('admin.book.index', compact('books'));
    }
}
