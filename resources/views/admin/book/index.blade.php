@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Manage Book</h1>
            <div>
                <a href="{{ route('admin.writers.create') }}" class="btn btn-primary">Add Book</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table">
            <thead>
                <th>No</th>
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
                    <td>{{ $loop->iteration }}</td>
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
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Details</a>
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                        document.getElementById('{{ 'delete-form'.$book->id }}').submit();">Delete</a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" id="{{ 'delete-form'.$book->id }}" class="d-none" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                <tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
