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
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-3 row-cols-lg-5 g-3">
            @foreach ($writer->books as $book)
                <div class="col position-relative">
                    <div class="card h-100">
                        <img class="card-image-top" src="{{ $book->cover_image }}" alt="image" style="width:100%">
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
    </div>
@endsection
