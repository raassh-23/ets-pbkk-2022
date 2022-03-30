@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Book Detail</h1>

        <h2>{{ $book->title }}</h2>
        <h4>Written by
            @foreach ($book->writers as $writer)
                <a
                    href="{{ url('/writer/' . $writer->id) }}">{{ $loop->last ? $writer->name : $writer->name . ',' }}</a>
            @endforeach
        </h4>
        <img src="{{ $book->cover_image }}" alt="image" width="300px" class="img-fluid">
        <p>{{ $book->synopsis }}</p>
        <p>Year: {{ $book->publish_year }}</p>
        <p>Edition: {{ $book->edition }}</p>
        <p>ISBN: {{ $book->isbn }}</p>

        <h2>Review</h2>
        @foreach ($book->reviews as $review)
            <a href="{{ url('/user/' . $review->user->id) }}">{{ $review->user->name }}</a>
            <p>Rating: {{ $review->rating }}</p>
            <p>{{ $review->review }}</p>
            @if ($review->user->id == Auth::user()->id)
                <form action="{{ url('/review/' . $review->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

                <form method='POST' action="{{ url('/review/' . $review->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $book->id }}" name="book_id">
                    <div class="form-group">
                        <label for="ratingInput">Rating</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="ratingHelp"
                            placeholder="Enter rating" name="rating" value="{{$review->rating}}">
                    </div>
                    <div class="form-group">
                        <label for="reviewInput">Review</label>
                        <input type="text" class="form-control" id="reviewInputID" placeholder="Enter review" 
                            name="review" value="{{$review->review}}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
                {{-- <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#{{$review->id}}">Edit</button> --}}
                
                {{-- <div class="modal" tabindex="-1" role="dialog" id="{{$review->id}}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit review</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endif
        @endforeach
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form method='POST' action="/review">
            @csrf
            <input type="hidden" value="{{ $book->id }}" name="book_id">
            <div class="form-group">
                <label for="ratingInput">Rating</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="ratingHelp"
                    placeholder="Enter rating" name="rating">
            </div>
            <div class="form-group">
                <label for="reviewInput">Review</label>
                <input type="text" class="form-control" id="reviewInputID" placeholder="Enter review" name="review">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection
