@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Book Detail</h1>
        
        <h2>{{ $book->title }}</h2>
        <h4>Written by 
            @foreach ($book->writers as $writer)
                <a href="{{ url('/writer/'.$writer->id) }}">{{ $loop->last ? $writer->name : $writer->name.',' }}</a>
            @endforeach
        </h4>
        <img src="{{ $book->cover_image }}" alt="image" width="300px" class="img-fluid">
        <p>{{ $book->synopsis }}</p>
        <p>Year: {{ $book->publish_year }}</p>
        <p>Edition: {{ $book->edition }}</p>
        <p>ISBN: {{ $book->isbn }}</p>

        <h2>Review</h2>
        @foreach ($book->reviews as $review)
            <a href="{{ url('/user/'.$review->user->id) }}">{{$review->user->name}}</a>
            <p>Rating: {{ $review->rating }}</p>
            <p>{{ $review->review }}</p>
            
        @endforeach
    </div>
@endsection
