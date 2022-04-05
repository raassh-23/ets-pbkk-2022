@extends('layouts.app')

@section('content')
    @php
        $startup_title = "ReviewYourBooks"
    @endphp

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik&display=swap');
        .welcome {
            position: relative;
        }
        .textWelcome {
            position: absolute;
            right: 20px;
            top: 150px;
            width: 600px;
        }
        #titleWelcome {
            font-family: 'Rubik', sans-serif;
            font-size: 84px;
            color: #5e5343;
            line-height: 80px;
        }

        #subtitleWelcome {
            color: #5e5343;
            font-size: 18px;
            line-height: 50px;
        }

        #contentWelcome {
            width: 600px;
            right: -200px;
        }
        

    </style>
    <div class="container">
        {{-- <h1><b> {{ $startup_title }}</b></h1> --}}
        <div class="welcome">
            <img src="{{URL::asset('../images/homepage-background.png')}}" alt="Welcome Pictures" height="610" width="100%">
            <span class="textWelcome">
                <h1 id="titleWelcome">Review<br>YourBooks</h1>
                <h4 id="subtitleWelcome"><b>THE WORLD OF BOOKS REVIEW & RATING</b></h4>
                <p id="contentWelcome"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ea deleniti nemo ipsam dolor. 
                    Tenetur, aliquid optio maxime, ipsum id nostrum incidunt, iusto perspiciatis corporis 
                    facere qui culpa nesciunt adipisci?</p>
                <button class="btn text-light" style="background: #5e5343;">Choose Your Book</button>
            </span>
        </div>


        <h2 class="mt-4">Most Reviewed</h2>
        @php
            $most_reviewed_books = $books->toQuery()->withCount('reviews')->orderBy('reviews_count', 'desc')->take(6)->get();
        @endphp
        <div class="row row-cols-2 row-cols-xs-2 row-cols-sm-4 row-cols-lg-6 g-3">
            @foreach ($most_reviewed_books as $book)
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

        <h2 class="mt-4">Highest Rating</h2>
        @php
            $highest_rating_books = $books->sortByDesc('rating')->take(6);
        @endphp
        <div class="row row-cols-2 row-cols-xs-2 row-cols-sm-4 row-cols-lg-6 g-3">
            @foreach ($highest_rating_books as $book)
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

        <h2 class="mt-4">Top Users</h2>
        @php $top_users = $users->sortByDesc('reviews')->take(4); @endphp
        <div class="row row-cols-2 row-cols-xs-2 row-cols-sm-3 row-cols-lg-4 g-3">
            @foreach ($top_users as $user)
                <div class="col position-relative">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class="img-fluid rounded-start" src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                    style="width:100%">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <a class="card-title fw-bold fs-5 stretched-link text-black text-decoration-none m-0"
                                        href="{{ route('users.show', ['user' => $user->id]) }}">{{ Str::limit($user->name, 13, '...') }}</a>
                                    <p class="my-0">{{ count($user->reviews) }} Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection