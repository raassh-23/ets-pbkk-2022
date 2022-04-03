@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-row">
            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}'s cover image" width="250px" height="330px">
            <div class="d-flex flex-column ms-3 mt-1">
                <h1 class="fw-bolder">{{ $book->title }}</h1>
                <h5>by :
                    @foreach ($book->writers as $writer)
                        <a
                            href="{{ url('/writer/' . $writer->id) }}">{{ $loop->last ? $writer->name : $writer->name . ',' }}</a>
                    @endforeach
                </h5>
                <h5>{{ $book->publisher->name }}</h5>
                <div class="d-flex flex-row">
                    <h6>Year: <b>{{ $book->publish_year }}</b></h6>
                    <h6 class="ms-3">Edition: <b>{{ $book->edition }}</b></h6>
                    <h6 class="ms-3">ISBN: <b>{{ $book->isbn }}</b></h6>
                </div>
                <p>Category: {{ $book->category->name }}</p>
                <p>Avg Rating: {{ $book->rating ?: 'no review yet' }}</p>
                <p class="mt-2">{{ $book->synopsis }}</p>
            </div>
        </div>
        @php $user_review = Auth::user()->reviews->where('book_id', $book->id)->first() @endphp
        <div class="container my-4 border border-2 rounded p-3">
            @if ($user_review != NULL)
                <div class="view-review">
                    <h4 class="fw-bold">Your review</h4>
                    <p class="my-0">Rating: {{ $user_review->rating }}</p>
                    <p class="my-0">{{ $user_review->review }}</p>

                    <div class="d-flex flex-row mt-3">
                        <form action="{{ route('books.reviews.destroy', ['book' => $book->id, 'review' => $user_review->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <button type="submit" class="btn btn-primary ms-2"  href="#" 
                            onclick="
                            $('.edit-review').slideToggle(
                                function(){
                                    $('#more').html($('.edit-review').is(':visible'));
                                }
                            );
                            $('.view-review').slideToggle(
                                function(){
                                    $('#more').html($('.view-review').is(':visible'));
                                }
                            );">Edit</button>
                    </div>
                </div>
                <div class="edit-review" style="display: none">
                    <h4 class="fw-bold">Edit your review</h4>
                    <form method='POST' action="{{ route('books.reviews.update', ['book' => $book->id, 'review' => $user_review->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="ratingInput">Rating</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="ratingHelp"
                                placeholder="Enter rating" name="rating" value="{{$user_review->rating}}">
                        </div>
                        <div class="form-group">
                            <label for="reviewInput">Review</label>
                            <input type="text" class="form-control" id="reviewInputID" placeholder="Enter review" 
                                name="review" value="{{$user_review->review}}">
                        </div>
                        <div class="d-flex flex-row mt-3">
                            <a class="btn btn-light" 
                                onclick="
                                $('.edit-review').slideToggle(
                                    function(){
                                        $('#more').html($('.edit-review').is(':visible'));
                                    }
                                );
                                $('.view-review').slideToggle(
                                    function(){
                                        $('#more').html($('.view-review').is(':visible'));
                                    }
                                );">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-2">Edit Review</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="no-review">
                    <h5>You haven't reviewed this book yet.</h5>
                <button class="btn btn-primary" 
                    onclick="
                    $('.add-review').slideToggle(
                        function(){
                            $('#more').html($('.add-review').is(':visible'));
                        }
                    );
                    $('.no-review').slideToggle(
                        function(){
                            $('#more').html($('.no-review').is(':visible'));
                        }
                    );">Add review</button>
                </div>
                
                <div class="add-review" style="display: none">
                    <h4 class="fw-bold">Add your review</h4>
                    <form method='POST' action="{{ route('books.reviews.store', ['book' => $book->id]) }}">
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
                        <div class="d-flex flex-row mt-3">
                            <a class="btn btn-light" 
                                onclick="
                                $('.add-review').slideToggle(
                                    function(){
                                        $('#more').html($('.add-review').is(':visible'));
                                    }
                                );
                                $('.no-review').slideToggle(
                                    function(){
                                        $('#more').html($('.no-review').is(':visible'));
                                    }
                                );">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-2">Send Review</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>

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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Reviews ({{ count($book->reviews) }})</h2>
        @if (($book->reviews->count() > 1 && $user_review != NULL) || ($book->reviews->count() > 0 && $user_review == NULL ))
            @foreach ($book->reviews as $review)
                @if ($review->user->id != Auth::user()->id)
                    <a class="fw-bold fs-4" href="{{ url('/user/' . $review->user->id) }}">{{ $review->user->name }}</a>
                    <p class="my-0">Rating: {{ $review->rating }}</p>
                    <p  class="my-0">{{ $review->review }}</p>
                    <br>
                @endif
            @endforeach
        @else
            <h5>No other reviews.</h5>
        @endif
    </div>
@endsection
