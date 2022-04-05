@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Books</h1>

        <div class="d-flex">
            <div class="col-sm-10">
                @if (count($books) > 0)
                    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-3 row-cols-lg-5 g-3">
                        @foreach ($books as $book)
                            <div class="col position-relative">
                                <div class="card h-100">
                                    <img class="card-image-top" src="{{ $book->cover_image }}" alt="image"
                                        style="width:100%">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <a class="card-title fw-bold fs-5 stretched-link text-black text-decoration-none m-0"
                                                href="{{ route('books.show', ['book' => $book->id]) }}">{{ Str::limit($book->title, 30, '...') }}</a>
                                            <p class="m-0">
                                                @foreach ($book->writers as $writer)
                                                    {{ $loop->last ? $writer->name : $writer->name . ',' }}
                                                @endforeach
                                            </p>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <span style="color: Orange;">
                                                <i class="fas fa-star"></i>
                                            </span>
                                            @if ($book->rating)
                                                <p class="ms-1 mb-0">{{ round($book->rating, 2) }} ({{ count($book->reviews)}} Reviews)</p>
                                            @else
                                                <p class="ms-1 mb-0">-</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h3 class="text-center">No books found.</h3>
                @endif
            </div>
            <div class="col-sm-2 ms-3">
                <div class="row-md-2 mb-3">
                    <h2>Search</h2>
                    <form method="GET" action="{{ route('books.index') }}">
                        <div class="d-flex flex-row">
                            <input type="text" class="form-control" placeholder="Search books..." name="search" value="{{ request()->search }}">
                            <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="row-md-2">
                    <h2>Categories</h2>
                    <ul class="list-group">
                        @foreach ($categories as $category)
                            <li class="list-group-item">
                                <a
                                    href="{{ route('books.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
