@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Publisher Detail</h1>
        
        <h2>{{ $publisher->name }}</h2>
        <p>Address: {{ $publisher->address }}</p>
        <p>Phone: {{ $publisher->phone }}</p>
        <p>Email: {{ $publisher->email }}</p>

        <h2>Books</h2>
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            @foreach ($publisher->books as $book)
                <div class="col">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{ $book->cover_image }}" alt="image" style="width:100%">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $book->title }}</h4>
                                <p class="card-text">{{ Str::limit($book->synopsis, 200, '...') }}</p>
                            </div>
                            <a href="{{ route('books.show', ['book' => $book->id]) }}" class="btn btn-primary mt-2">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
