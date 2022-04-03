@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-row">
            <img src="{{ $writer->image_url }}" alt="{{ $writer->name }}'s cover image" width="200px" height="200px">
            <div class="d-flex flex-column ms-3 mt-1">
                <h6 class="text-primary mb-0">WRITER</h6>
                <h1 class="fw-bolder">{{ $writer->name }}</h1>
                <p class="mb-1"><b>Address</b> {{ $writer->address }}</p>
                <p class="mb-1"><b>Email</b> {{ $writer->email }}</p>
                <p><b>Phone</b> {{ $writer->phone }}</p>
            </div>
        </div>

        <h2 class="mt-5">Books ({{ count($writer->books) ?: 0 }})</h2>
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            @foreach ($writer->books as $book)
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
