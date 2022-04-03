@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Books</h1>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add Book</a>

        <table>
            <thead>
                <th>ISBN</th>
                <th>Title</th>
                <th>Category</th>
                <th>Writer</th>
                <th>Publisher</th>
                <th>Review Count</th>
                <th>Average Rating</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>
                        @foreach ($book->writers as $writer)
                            {{ $loop->last ? $writer->name : $writer->name . ',' }}                  
                        @endforeach
                    </td>
                    <td>{{ $book->publisher->name }}</td>
                    <td>{{ count($book->reviews) }}</td>
                    <td>{{ $book->rating ? round($book->rating, 2) : 0 }}</td>
                    <td>
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Details</a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                <tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
