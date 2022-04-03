@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Publishers</h1>
        <div class="d-flex">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                @foreach ($publishers as $publisher)
                    <div class="col position-relative">
                        <div class="card h-100">
                            <img class="card-image-top" src="{{ $publisher->image_url }}" alt="{{ $publisher->name }}" style="width:100%">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <a class="card-title fw-bold fs-5 stretched-link text-black text-decoration-none m-0" href="{{ route('publishers.show', ['publisher' => $publisher->id]) }}">{{  Str::limit($publisher->name, 30, '...') }}</a>
                                <p class="m-0">{{ count($publisher->books)}} books published</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-2 ms-3">
                <h2>Search</h2>
                <form method="GET" action="{{ route('publishers.index') }}">
                    <div class="d-flex flex-row">
                        <input type="text" class="form-control" placeholder="Search publishers..." name="search">
                        <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection