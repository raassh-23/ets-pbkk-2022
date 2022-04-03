@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-row">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}'s avatar" width="200px" height="200px">
            <div class="d-flex flex-column ms-3 mt-1">
                <h6 class="text-primary mb-0">USER</h6>
                <h1 class="fw-bolder">{{ $user->name }}</h1>
                <p class="mb-1"><b>Email</b> {{ $user->email }}</p>
            </div>
        </div>

        <h2 class="mt-4">Reviews ({{ count($user->reviews) ?: 0 }})</h2>
        @foreach ($user->reviews as $review)
            <a class="fw-bold fs-4" href="{{ route('books.show', ['book' => $review->book->id]) }}">{{ $review->book->title }}</a>
            <p class="my-0">Rating: {{ $review->rating }}</p>
            <p class="my-0">{{ $review->review }}</p>
            <br>
        @endforeach
    </div>
@endsection
