@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Detail</h1>
        
        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}'s avatar" width="250px" height="330px">
        <h2>{{ $user->name }}</h2>
        <p>Email: {{ $user->email }}</p>

        <h2>Reviews</h2>
        @foreach ($user->reviews as $review)
            <a class="fw-bold fs-4" href="{{ route('books.show', ['book' => $review->book->id]) }}">{{ $review->book->title }}</a>
            <p class="my-0">Rating: {{ $review->rating }}</p>
            <p  class="my-0">{{ $review->review }}</p>
            <br>
        @endforeach
    </div>
@endsection
